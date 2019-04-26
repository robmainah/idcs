<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\File;
use App\Task;
use Input;
use DB;
use PDF;
use Validator;
use Carbon\Carbon;
use App\Employee;
use App\FileShared;
use App\Message;

class FilesController extends Controller
{
	public function __construct () {

		$this->middleware('auth');
	}

    public function index () {
    	$files = File::where('employee_id', auth()->id())->latest()->get();
    	$messages = Message::Where('from_user_id', auth()->id())->take(3)->latest()->get();
    	$navTasks = Task::Where('from_user_id', auth()->id())->orderBy('complete')->latest()->limit(4)->get();
    	$fileShared = FileShared::where('sent_to', auth()->id())->get(['id', 'file_id']);
	    $employees = Employee::all();
	    $emp_role_id = Employee::where('id', auth()->id())->get();
	    if ($emp_role_id[0]['role'] == 1) {
		    $files_count = count($employees);
		    
		    for ($i=0; $i < $files_count; $i++) {
		    	//return $employees[2];
		    	$files_check = File::where('employee_id', $employees[$i]['id'])->get(['size']);
		        //return $files[0]['size'];
		    	$sum = 0;
		    	foreach ($files_check as $value) {
		    		$sum += $value['size'];
		    	}
		    	
		    	$employees[$i]['files_total'] = $sum;
		    	//return $employees[$i];
		    }

	   		return view('pages.files', compact('employees', 'files', 'messages', 'navTasks', 'fileShared'));
	    }
	    else
	    {
	    	return view('pages.files', compact('employees','files', 'messages', 'navTasks', 'fileShared'));
	    }
    }

    public function printAll()
	{
		$files = File::latest()->get()->where('employee_id', auth()->id());
    	$fileShared = FileShared::get(['id', 'file_id'])->where('sent_to', auth()->id());
    	$employees = Employee::all();
    	$files_count = count($files);
	    $emp_role_id = Employee::where('id', auth()->id())->get();
	    if ($emp_role_id[0]['role'] == 1) {
		    $files_count = count($employees);
		    for ($i=0; $i < $files_count; $i++) {
		    	$files_check = File::where('employee_id', $employees[$i]['id'])->get(['size']);
		    	$sum = 0;
		    	foreach ($files_check as $value) {
		    		$sum += $value['size'];
		    	}
		    	$employees[$i]['files_total'] = $sum;
		    }
		    $pdf = PDF::loadView('pages.printFilesAll', compact('employees', 'files', 'fileShared'));
	    }
	    else
	    {
	    	$pdf = PDF::loadView('pages.printFilesAll', compact('employees', 'files', 'fileShared'));
	    }

    	
    	return $pdf->stream('files.pdf');
	}

    public function fileInfo ($filePath) {
    	$file = array();
    	$file['name'] = $filePath['filename'];
    	$file['extension'] = $filePath['extension'];
    	$file['size'] = filesize($filePath['dirname'].'/'.$filePath['basename']);

    	return $file;
    }

    public function store (Request $req) {
    	$rules = array (
    		'uploadImage' => 'required',
    		'description' => 'required',
    	);

    	$validator = Validator::make(Input::all(), $rules);
    	if ($validator->fails()) {

    		return Response::json(['errors' => $validator->errors()]);
    	}
    	else 
    	{
	        if ($req->hasFile('uploadImage')) {
	        	$currentFolder = session('currentFolder');
	    		foreach ($req->uploadImage as $files) {
	    			$name = $files->getClientOriginalName();
	    			$size = $files->getClientSize();
	    			$last_modified = filemtime($files);
			        $extension = $files->getClientOriginalExtension();
			        $destinationPath = storage_path("app/".$currentFolder."/files");
			        $checkPath = storage_path("app/".$currentFolder."files/".$name);
			        
			        if (file_exists($checkPath)) {
			        	return Response::json(['errors' => 'exists']);
			        }
			        else
			        {
	        	        $files->move($destinationPath, $name);
	        	        
	        	        File::create([
    		        		'employee_id' => auth()->id(),
    		        		'name' => pathinfo($name, PATHINFO_FILENAME),
    		        		'size' => $size,
    		        		'description' => $req->description,
    		        		'last_modified' => $last_modified,
    		        		'type' => $extension,
    		        	]);
			        }
	    		}
			    return Response::json(['success' => 1]);
	    	}
    	}
	}

	public function newFolder (Request $req) {
		$currentFolder = session('currentFolder');
			
		if (Storage::makeDirectory($currentFolder."/".$req->name)) {
			return Response::json(['new folder created']);
		}
		else{
			return Response::json(['failed']);
		}
	}

	public function openFolder (Request $req) {
		$currentFolder = session('currentFolder');
		session(['currentFolder' => $currentFolder.'/'.$req->folder]);
		$directories = Storage::directories($currentFolder."/".$req->folder);
		$directories = array_map('basename', $directories);
		$files = Storage::files($currentFolder."/".$req->folder);
		$files = array_map('basename', $files);
		
		return compact('directories', 'files');
	}

	public function copyPaste (Request $req) {
		$content = $req->content;
		$content_arr = explode(",", $content);
		$i = 0;
		foreach ($content_arr as $value) {
			$get_item = File::where('id', $value)->get(['name', 'type']);
			$item_name = $get_item[0]['name'];
			$item_extension = $get_item[0]['type'];
			$path = "files/".$item_name.".".$item_extension;
			$newName = $item_name."(copy)";
			$checkPath = storage_path("app/files/".$newName.".".$item_extension);
			if (file_exists($checkPath)) {
				return Response::json(['errors' => 'exists']);
			}
			else
			{
				if(Storage::copy($path, "files/".$newName.".".$item_extension) == true) {
					$get_item = File::where('id', $value)->get(['description', 'size', 'type', 'last_modified']);
			        $set_item = File::create([
		        		'employee_id' => auth()->id(),
		        		'name' => pathinfo($newName, PATHINFO_FILENAME),
		        		'size' => $get_item[$i]['size'],
		        		'description' => $get_item[$i]['description'],
		        		'last_modified' => $get_item[$i]['last_modified'],
		        		'type' => $get_item[$i]['type'],
		        	]);

					if ($set_item != true) {
						return Response::json(['errors' => 1]);
					}
					else
					{
						return Response::json(['success' => 1]);
					}				
				}
			}
		}
	}

	public function rename (Request $req) {
		$newName = $req->name;
		$old = $req->oldName;
		$files = File::where('id', $old)->get(['name', 'type']);
		$file_name = $files[0]['name'].".".$files[0]['type'];
		$updateColumn = File::where('id', $old)->update(['name' => $newName]);
		if ($updateColumn) {
			if (Storage::move("files/".$file_name, "files/".$newName.".".$files[0]['type'])) {
				return Response::json(['success' => 1]);
			}
			else
			{
				return Response::json(['errors' => 1]);
			}
		}
	}

	public function download ($file_name) {
		$file_path = public_path('storage/files/'.$file_name);
		if (!is_file($file_path)) {
			return Response::json(['errors' => 'not_file']);
		}
		$headers = ['Content-Type: application/image'];
		return response()->download($file_path);
	}

	public function send (Request $req) {
		$users = $req->get('data');
		$users_str = implode($users, ",");
		$fils = $req->get('file');
		foreach ($fils as $file) {
			$fileShare = new FileShared ();
			if (FileShared::where('file_id', $file)->exists()) {
				$getColumn = FileShared::where('file_id', $file)->get(['sent_to', 'id']);
				$sent_array = explode(",", $getColumn[0]['sent_to']);
				foreach ($users as $user) {
					if (!in_array($user, $sent_array)) {
						$updateColumn = FileShared::where('file_id', $file)->update(['sent_to' => $getColumn[0]['sent_to'].",".$user]);
						$updateColumn;
					}
				}
			}
			else
			{
				$file_id = $req->get('file');
				$fileShare->file_id = $file;
				$fileShare->sent_by = auth()->id();
				$fileShare->sent_to = $users_str;
				$fileShare->seen_by = 0;
				$fileShare->save();
			}
		}

		return Response::json(['success' => 1]);
	}
	public function fileType($type) {
		$files = FileShared::get(['id', 'file_id'])->where('sent_to', auth()->id());
		if ($type == "sent") {
			$files = FileShared::get()->where('sent_by', auth()->id());
		}
		$employee = Employee::latest()->get();

		return Response::json(['employee' => $employee, 'files' => $files]);
	}

	public function print() {
		$files = File::latest()->get()->where('employee_id', auth()->id());
    	$fileShared = FileShared::get(['id', 'file_id'])->where('sent_to', auth()->id());
    	$employees = Employee::latest()->get();
    	$emp_role_id = Employee::where('id', auth()->id())->get();
	    if ($emp_role_id[0]['role'] == 1) {
		    $files_count = count($employees);
		    for ($i=0; $i < $files_count; $i++) {
		    	$files_check = File::where('employee_id', $employees[$i]['id'])->get(['size']);
		    	$sum = 0;
		    	foreach ($files_check as $value) {
		    		$sum += $value['size'];
		    	}
		    	
		    	$employees[$i]['files_total'] = $sum;
		    }
	   		//return view('pages.files', compact('employees', 'files', 'messages', 'navTasks', 'fileShared'));
	    }
    	$pdf = PDF::loadView('pages.printFiles', compact('employee', 'files', 'fileShared'));
    	return $pdf->stream('files.pdf');
	}

	public function destroy (Request $req) {
		$file_in_array = $req->id;
		$file = File::whereIn('id', $file_in_array);
		$file->delete();
    }
}

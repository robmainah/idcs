<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mainDepartment;
use App\subDepartment;
use App\Task;
use App\Employee;
use DB;
use PDF;
use Input;
use Response;
use Validator;
use App\Message;

class DepartmentsController extends Controller
{
	public function __construct () {

		$this->middleware('auth');
	}

    public function index () {

    	$departments = mainDepartment::withCount('employee')->latest()->get();
        $messages = Message::Where('from_user_id', auth()->id())->take(3)->latest()->get();

        $navTasks = Task::Where('from_user_id', auth()->id())->orderBy('complete')->latest()->limit(4)->get();

    	$subdepartments = subDepartment::latest()->get();

        $employees = Employee::all();

    	return view('pages.departments', compact('departments', 'messages', 'subdepartments', 'navTasks', 'employees'));
    }

    public function store (Request $req) {

    	$rules = array(
    		'depart_name' => 'required | unique:mainDepartments,name',
			'depart_hod' => 'required',
			'depart_desc' => 'required',
    	);
        
        $sect = $req->depart_section;
        if ($sect == "add-sub") {
            $rules['mainDepart'] = 'required';
        }

    	$validator = Validator::make(input::all(), $rules);

    	if ($validator->fails()) {
    		return Response::json(['errors' => $validator->errors()]);
    	}
    	else
    	{
            $departments = new MainDepartment;
            if ($sect == "add-sub") {
                $departments = new SubDepartment;
            }
            $depId = random_int(100001, 999999);
            $exists = DB::table('mainDepartments')->where('depart_id', $depId)->first();

            if ($exists) {
                return Response::json(['exist' => 'department id already exists']);
            }
            else
            {
                $departments->depart_id = $depId;
                $departments->name = $req->depart_name;
                $departments->hod_id = $req->depart_hod;
                $departments->description = $req->depart_desc;

                if ($sect == "add-sub") {
                    $departments->depart_id = $req->mainDepart;
                }

                $departments->save();

                return Response::json(['success' => '1']);
            }
    	}
    }
    public function update (Request $req) {

        $rules = array(
            'depart_name' => 'required',
            'depart_hod' => 'required',
            'depart_desc' => 'required',
        );
        
        $sect = $req->depart_section;
        if ($sect == "add-sub") {
            $rules['mainDepart'] = 'required';
        }

        $validator = Validator::make(input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()]);
        }
        else
        {
            
            $departments = new MainDepartment;

            if ($sect == "add-sub") {
                $departments = new SubDepartment;
            }

            DB::table('mainDepartments')->where('id', $req->depart_id)->update([
                'name' => $req->depart_name,
                'hod_id' => $req->depart_hod,
                'description' => $req->depart_desc,
            ]);
            if ($sect == "add-sub") {
                $departments->depart_id = $req->mainDepart;
            }

            return Response::json(['success' => '1']);
        }
    }

    public function view (mainDepartment $department) {

    	return $department;
    }

    public function print () {

        $departments = mainDepartment::withCount('employee')->latest()->get();

        $subdepartments = subDepartment::latest()->get();

        $employees = Employee::all();

        $pdf = PDF::loadView('pages.printDepartment', compact('departments', 'subdepartments', 'employees'));
        return $pdf->stream('departments.pdf');
    }

    public function destroy (mainDepartment $department) {
        $department->delete();

        return Response::json(['success' => 1]);
    }
}

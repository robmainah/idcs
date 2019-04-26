<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mainDepartment;
use App\User;
use App\Task;
use Input;
use PDF;
use Validator;
use Response;
use App\Message;

class TasksController extends Controller
{
	public function __construct () {

		//$this->middleware('auth');
	}

    public function index () {

    	$departments = mainDepartment::all();
    	$users = user::all();

        $tasks = Task::Where('from_user_id', auth()->id())->orderBy('complete')->latest()->get();
        $tasksTo = Task::Where('to_user_id', auth()->id())->orderBy('complete')->latest()->get();
        $tasksFrom = Task::Where('from_user_id', auth()->id())->orderBy('complete')->latest()->get();
        $navTasks = Task::Where('from_user_id', auth()->id())->orderBy('complete')->latest()->limit(4)->get();
        $messages = Message::Where('from_user_id', auth()->id())->take(3)->latest()->get();

    	return view('pages.tasks', compact('tasks', 'tasksTo', 'tasksFrom', 'navTasks', 'messages', 'departments', 'users'));
    }

    public function store (Request $req) {
    	$rules = array(
    		'task_members' => 'required',
    		'task_desc' => 'required',
    	);
    	$validator = Validator::make(input::all(), $rules);

    	if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()]);
    	}

		$user_to = explode(",", $req->task_members);
        $count = count($user_to);

        $count_number = Task::all()->last()->id + 5;
		foreach ($user_to as $user) {
			$task = new Task;
			$task->subject = 1;
			$task->description = $req->task_desc;
			$task->from_user_id = auth()->id();
			$task->to_user_id = $user;

			$task->save(); 
		}

    	return Response::json(['success' => 1]);
    }

    public function getUsers ($id) {
    	$users = User::where('depart_id', $id)->get(['id', 'name']);
    	if ($id == "all") {
    		$users = User::all();
    	}
    	
    	return Response::json(['users' => $users]);
    }

    public function taskIsRead ($id) {
        $user = Message::where('id', $id)->get(['to_user_id']);
        if ($user[0]['to_user_id'] == auth()->id()) {
            Task::where('id', $id)->update(['read_status' => 1]);
        }
        
        return Response::json(['success' => 1]);
    }

    public function complete (Request $req) {
        Task::where('id', $req->id)->update(['complete' => $req->complete]);
        
        return Response::json(['success' => 1]);
    }

    public function print()
    {
        $departments = mainDepartment::all();
        $users = user::all();
        $tasks = Task::where('to_user_id', auth()->id())->orWhere('from_user_id', auth()->id())->latest()->get();
        $pdf = PDF::loadView('pages.printTasks', compact('tasks', 'departments', 'users'));
        
        return $pdf->stream('tasks.pdf');
    }

    public function destroy (Request $req) {
    	$task_in_array = $req->id;
		$task = Task::whereIn('id', $task_in_array);
		if ($task->delete()) {
			return Response::json(['success' => 1]);
		}
    }
}

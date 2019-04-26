<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AfricasTalkingGateway;
use App\Message;
use App\User;
use App\Task;
use App\mainDepartment;
use Validator;
use Input;
use Response;
use PDF;

class MessagesController extends Controller
{
	public function __construct () {

		$this->middleware('auth');
	}

	public function index () {
        $messages = Message::Where('from_user_id', auth()->id())->take(3)->latest()->get();
		$messagesTo = Message::where('to_user_id', auth()->id())->latest()->get();
		$messagesFrom = Message::Where('from_user_id', auth()->id())->latest()->get();
        $navTasks = Task::Where('from_user_id', auth()->id())->orderBy('complete')->latest()->limit(4)->get();
		$departments = mainDepartment::latest()->get();
		$users = User::latest()->get();

		return view('pages.messages', compact('messagesTo', 'messagesFrom', 'messages', 'departments', 'navTasks', 'users'));
	}

	public function store(Request $req)
	{
		$rules = array(
    		'send_to' => 'required',
    		'desc' => 'required',
    	);

    	$validator = Validator::make(input::all(), $rules);

    	if ($validator->fails()) {

            return Response::json(['errors' => $validator->errors()]);
    	}
    	$user_to = explode(",", $req->send_to);
        $count = count($user_to);
        $i=0;
		foreach ($user_to as $user) {
			$phone = User::where('id', $user)->get(['phoneNumber'])->all();
			$message = new Message;
			$message->to_user_id = $user;
			$message->text = $req->desc;
			$message->from_user_id = auth()->id();
			$message->save();
			$message->message($phone[$i]['phoneNumber'], $message->text);
			return ;
		}
	}

    public function print ()
    {
    	$messagesTo = Message::where('to_user_id', auth()->id())->orWhere('from_user_id', auth()->id())->latest()->get();
		$departments = mainDepartment::latest()->get();
		$users = User::latest()->get();
    	$pdf = PDF::loadView('pages.printMessages', compact('messagesTo', 'messagesFrom', 'departments', 'users'));

    	return $pdf->stream('messages.pdf');
    }

    public function messageIsRead ($id) {
        $user = Message::where('id', $id)->get(['to_user_id']);
        if ($user[0]['to_user_id'] == auth()->id()) {
            Message::where('id', $id)->update(['read_status' => 1]);
        }
        
        return Response::json(['success' => 1]);
    }

	public function destroy (Request $req) {
		$file_in_array = $req->id;
		$file = Message::whereIn('id', $file_in_array);
		$file->delete();
    }
}

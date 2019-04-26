<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Employee;
use App\mainDepartment;
use App\Position;
use App\Task;
use Validator;
use Response;
use Input;
use DB;
use PDF;
use Carbon\Carbon;
use App\Message;

class EmployeesController extends Controller
{
    public function __construct () {

        $this->middleware('auth');
    }

    public function index () {
    	$employee = Employee::latest()->get();
        $messages = Message::Where('from_user_id', auth()->id())->take(3)->latest()->get();
        $navTasks = Task::Where('from_user_id', auth()->id())->orderBy('complete')->latest()->get();
        $positions = Position::all();
        $departments = mainDepartment::all();

    	return view('pages.employees', compact('employee', 'messages', 'positions', 'navTasks', 'departments'));
    }

    public function store (Request $req) {
    	$rules = array(
    		'employeeName' => 'required | regex:/^[a-zA-Z\s]+$/',
    		'employeeDOB' => 'required | date | before:today',
    		'employeePhone' => 'required|numeric|min:7',
    		'employeeEmail' => 'required | email | unique:users,email',
    		'employeeAddress' => 'required',
    		'employeeGender' => 'required',
    		'employeeDepartment' => 'required',
    		'employeeStatus' => 'required',
        );
    	$validator = Validator::make(input::all(), $rules);

    	if ($validator->fails()) {

            return Response::json(['errors' => $validator->errors()]);
    	}
    	else
    	{
    		$employee = new Employee;

            $name = "";
    		if ($req->hasFile('uploadImage')) {
		        $image = $req->file('uploadImage');
		        $name = time().'.'.$image->getClientOriginalExtension();
		        $destinationPath = public_path('/images');
		        $image->move($destinationPath, $name);
		    }
            $empNo = random_int(100001, 999999);
            $exists = DB::table('employees')->where('employee_no', $empNo)->first();
            if ($exists) {
                return Response::json(['exist' => 'department id already exists']);
            }
            else
            {
        		$employee->name = $req->employeeName;
        		$employee->Dob = $req->employeeDOB;
        		$employee->phoneNumber = $req->employeePhone;
        		$employee->email = $req->employeeEmail;
        		$employee->image = $name;
                $employee->address = $req->employeeAddress;
        		$employee->password = bcrypt("123456");
                $employee->gender = $req->employeeGender;
        		$employee->status = $req->employeeStatus;
        		$employee->depart_id = $req->employeeDepartment;
        		$employee->role = 1;
                $employee->save();
        		        
                return response()->json(['success'=>'1']);
            }
    	}
    }
  
    public function view($employee) {
        $emp_dep = Employee::Where('id',$employee)->get();
        $dep = mainDepartment::Where('id',$emp_dep[0]['depart_id'])->get(['name']);
        $dep_name = $dep[0]['name'];
        $emp_date_birth = $emp_dep[0]['Dob'];
        $age = floatval(date('Y-m-d H:i:s')) - floatval($emp_date_birth);
        $emp_dep[0]['department'] = $dep_name;
        if ($emp_dep[0]['status'] == 1) {
            $emp_dep[0]['status'] = "Active";
        }
        else
        {
            $emp_dep[0]['status'] = "Not Active";
        }

        return $emp_dep[0];
    }

    public function update (Request $req) {
        
        $rules = array(
            'employeeName' => 'required | regex:/^[a-zA-Z\s]+$/',
            'employeeDOB' => 'required | date | before:today',
            'employeePhone' => 'required | numeric | min:10',
            'employeeEmail' => 'required | email',
            'employeeAddress' => 'required',
            'employeeGender' => 'required',
            'employeeDepartment' => 'required',
            'employeeStatus' => 'required',
            'uploadImage' => 'image | mimes:jpeg,png,jpg,gif,svg | max:2048',
        );
        $validator = Validator::make(input::all(), $rules);

        if ($validator->fails()) {

            return Response::json(['errors' => $validator->errors()]);
        }
        else
        {
            $name = "";
            if ($req->hasFile('uploadImage')) {
                $image = $req->file('uploadImage');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $name);
                $employee->image = $name;
            }

            DB::table('users')->where('id', $req->employee_id)->update([
                'name' => $req->employeeName,
                'Dob' => $req->employeeDOB,
                'phoneNumber' => $req->employeePhone,
                'email' => $req->employeeEmail,
                 
                'address' => $req->employeeAddress,
                'gender' => $req->employeeGender,
                'depart_id' => $req->employeeDepartment,
                'status' => $req->employeeStatus,
            ]);
            return response()->json(['success'=>'1']);
        }
    }

    public function print () {
        $employee = Employee::latest()->get();

        $positions = Position::all();

        $departments = mainDepartment::all();

        $pdf = PDF::loadView('pages.printEmployee', compact('employee', 'positions', 'departments'));

        return $pdf->stream('employees.pdf');
    }

    public function delete(Employee $employee) {
        $employee -> delete();

        return Response::json($employee);
    }
}

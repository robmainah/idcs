@extends('layouts.master')

@section('content')
    <div id="page-wrapper">
        <div class="row row-edit">
            <div class="col-lg-12">
                <div class="row display_message">
                    <div class="col-md-12 alert alert-success">
                        <div class="alertMessage">
                            <!-- Display data messages -->Data has successfully been deleted.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default pan-emp">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 ">
                                <h1 class="page-header pg-hed">Employees</h1>
                            </div>
                            <div class="col-lg-6 col-md-6 ">
                                <div class="pull-right tab-pull-right text-center">
                                    <span class="btn btn-primary btn-xs ta-print"><a href="/employees/print" target="_blank"><i class="fa fa-styling fa-print"></i> print</a></span>
                                    <span class="plus fa-styl" data-toggle="modal" data-target="#employee-modal">
                                    <i class="fa fa-user-plus fa-1x fa-styling employ_add" title="new employee"></i></span>
                                    <span class="fa-styl"><i class="fa fa-eye fa-1x fa-styling employ_view" title="view"></i></span>
                                    <span class="fa-styl"><i class="fa fa-pencil fa-1x fa-styling employ_edit" title="edit"></i></span>
                                    <span class="fa-styl"><i class="fa fa-trash fa-1x fa-styling employ_delete" title="delete"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <div id="file_table_data" class="table-responsive">
                                <div class="myTable" style="margin-top: 10px;">
                                    <table class="table table-striped table-bordered table-hover tbl_employees" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <td></td>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Phone No.</th>
                                                <th>Email</th>
                                                <th>position</th>
                                                <th>Department</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1; ?>
                                        @foreach($employee as $key => $value)
                                            <tr id="{{$value->id}}">
                                                <td id="fil_td" class="fil_sel">
                                                    <input type="checkbox" class="chk_tb" id="{{$value->id}}">
                                                </td>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->phoneNumber }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->role == 1 ? "admin" : "standard" }}</td>
                                                <td>{{ $value->mainDepartment->name }}</td>
                                                <td>
                                                    @if($value->status == 0)
                                                        <span class="col-danger" style="color: red">Not active</span>
                                                    @elseif($value->status == 1)
                                                        <span class="col-success">Active</span>
                                                    @elseif($value->status == 2)
                                                        <span class="col-warning">Pending</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- /.table-responsive -->
                    </div> <!-- /.panel-body -->
                </div> <!-- /.panel -->
            </div> <!-- /.col-lg-12 -->
        </div>
        <div class="modal fade " id="employee-modal" name="employeesForm" tabindex="-1" role="dialog" aria-labelledby="modalDepartmentLabel" >
            <div class="modal-dialog modal-lg animated fadeInLeft" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalUploadEmplLabel">Add new Employee</h4>
                    </div>
                    <form class="employeeForm" method="post" enctype="multipart/form-data">
                        {{ csrf_field () }}
                        <input type="hidden" name="employee_id" id="employee_id">

                        <div class="modal-body">
                            <!-- csrf -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 cosm-12">
                                    <div class="form-group">
                                        <label for="employeeName" class="control-label">Employee Name</label>
                                        <span class="error hidden name_err"></span>
                                        <input type="text" name="employeeName" class="form-control" id="employeeName">
                                    </div>
                                    <div class="form-group">
                                        <label for="employeeDOB" class="control-label">Date of Birth</label>
                                        <span class="error hidden dob_err"></span>
                                        <div class="input-group date" id='datetimepicker1'>
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div>
                                            <input type="text" class="form-control" name="employeeDOB" id="employeeDOB">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email</label>
                                        <span class="error hidden email_err"></span>
                                        <input type="text" class="form-control" name="employeeEmail" id="employeeEmail">
                                    </div>
                                    <div class="form-group">
                                        <label for="employeeGender" class="control-label">Gender</label>
                                        <span class="error hidden gender_err"></span>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" class="male" name="employeeGender" id="employeeGender" value="2" ><strong>Male</strong>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" class="female" name="employeeGender" id="employeeGender" value="1"><strong>Female</strong>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="employeePhone" class="control-label">Phone number</label>
                                        <span class="error hidden phone_err"></span>
                                        <input type="text" class="form-control" id="employeePhone" name="employeePhone">
                                    </div>
                                    <div class="form-group">
                                        <label for="employeeAddress" class="control-label">Address</label>
                                        <span class="error hidden add_err"></span>
                                        <input type="text" class="form-control" name="employeeAddress" id="employeeAddress">
                                    </div>
                                    <div class="form-group">
                                        <label for="Department" class="control-label">Department</label>
                                        <span class="error hidden dep_err"></span>
                                        <select name="employeeDepartment" id="employeeDepartment" class="form-control">
                                            <option value="">Select Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id}}">{{ ucFirst($department->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="employeeStatus" class="control-label">Status</label>
                                        <span class="error hidden status_err"></span>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" class="activeOne" name="employeeStatus" id="employeeStatus" value="1"><strong>Active</strong>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" class="notActive" name="employeeStatus" id="employeeStatus" value="0"><strong>Not Active</strong>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="buttonSave">Add Employee <i class="fa fa-send"></i></button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="employee_view" tabindex="-1" role="dialog" aria-labelledby="modalEmployeeView" >
            <div class="modal-dialog animated fadeInLeft" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalEmployeeView">Employee details</h4>
                        <button class="btn btn-default btn-sm md-edit" data-dismiss="modal">Close</button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                             <table class="table table-hover table-striped table-bordered tbl_emp_view">
                                <tbody></tbody>
                             </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop
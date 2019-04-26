@extends('layouts.master')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="row display_message">
                    <div class="col-md-12 alert alert-success">
                        <div class="alertMessage">
                            <!-- Display data messages -->Data has successfully been deleted.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-6 col-md-6 ">
                        <h1 class="page-header pg-hed">Departments</h1>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="pull-right tab-pull-right text-center">
                            <span class="btn btn-primary btn-xs ta-print"><a href="/departments/print" target="_blank"><i class="fa fa-styling fa-print"></i> print</a></span>
                            <span class="plus fa-styl" data-toggle="modal" data-target="#addDepartment">
                                <i class="fa fa-plus fa-1x fa-styling depart_add" title="new department"></i></span>
                            <span class="fa-styl"><i class="fa fa-pencil fa-1x fa-styling depart_edit" title="edit"></i></span>
                            <span class="fa-styl"><i class="fa fa-trash fa-1x fa-styling depart_delete" title="delete"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="myTable" style="margin-top: 10px;">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Department name</th>
                            <th style="width: 13%;">H.O.D</th>
                            <th style="width: 35%">Description</th>
                            <th style="width: 13%">No. of Employees</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($departments as $value)
                            <tr id="{{ $value->id }}">
                                <td id="fil_td" class="fil_sel">
                                        <input type="checkbox" class="chk_tb" id="{{$value->id}}">
                                </td>
                                <td>{{ $no++ }}</td>
                                <td>{{ strtoupper($value->name) }}</td>
                                <td>{{ strtoupper($value->hod->name) }}</td>
                                <td>{{ $value->description }}</td>
                                <td>{{ $value->employee_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade " id="addDepartment" tabindex="-1" role="dialog" aria-labelledby="modalDepartmentLabel" >
            <div class="modal-dialog animated fadeInLeft" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalUploadFileLabel">Add new Department</h4>
                    </div>
                    <div class="tab-content">
                        <div id="main_depart" class="tab-pane active">
                            <form action="/departments" class="form-horizontal" method="post" enctype="multipart/form-data" id="dep-form">
                                {{ csrf_field () }}
                                <input type="hidden" name="action_type" id="action_type" value="">
                                <input type="hidden" name="dep_id" id="dep_id" value="">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="depart_name" class="control-label col-sm-3 prj-title"> Department name</label>
                                        <div class="col-sm-9">
                                            <span class="error depart_name_error hidden"></span>
                                            <input type="text" name="depart_name" class="form-control" id="depart_name">
                                        </div>
                                    </div>
                                    <div class="form-group prj-main-dep hidden">
                                        <label for="mainDepartment" class="control-label col-sm-3">Main Department</label>
                                        <span class="error mainDepartError hidden"></span>
                                        <div class="col-sm-9">
                                            <select name="mainDepart" id="mainDepart" class="form-control">
                                                <option value="">Select main Department</option>
                                                @foreach($departments as $dep)
                                                    <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="hod" class="control-label col-sm-3"><span style="color: #ccc;font-size: 13px">*optional*</span> H.O.D</label>
                                        <div class="col-sm-9">
                                            <span class="error depart_hod_error hidden"></span>
                                            <select name="depart_hod" id="depart_hod" class="form-control">
                                                <option value="">Select from employees</option>
                                                @foreach($employees as $emp)
                                                    <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="depart_desc" class="control-label col-sm-3">Description</label>
                                        <div class="col-sm-9">
                                            <span class="error depart_desc_error hidden"></span>
                                            <textarea name="depart_desc" id="depart_desc" class="form-control" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="saveDepartment" value="add-main">Add Department <i class="fa fa-send"></i></button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@extends('layouts.master')

@section('content')
    <div id="page-wrapper">
        <div class="row display_message">
            <div class="col-lg-12">
                <div class="display_message" -->
                    <div class="col-md-12 alert alert-success">
                        <div class="alertMessage">
                            <!-- Display data messages -->Data has successfully been deleted.
                        </div>
                    </div>
                </div>
            </div> <!-- /..col-lg-12 -->
        </div> <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                            @if(auth::user()->role == 1)
                                <ul id="myTabs" class="nav nav-tabs nav-pills" role="tablist">
                                    <li role="presentation" class="active"><a href="#me" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">me</a></li>
                                    <li role="presentation" class=""><a href="#all" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">All</a></li>
                                </ul>
                            @endif
                            
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="me" aria-labelledby="home-tab">
                                    <div class="panel panel-default">
                                        <div class="panel-heading hd-ed">
                                            <div class="row">
                                                <div class=" col-md-12">
                                                    <div class="text-center">
                                                        <ul class="fil-tp-lnk text-right">
                                                            <li><a class="copy fil-ed disabled">Copy</a></li>
                                                            <li><a class="paste fil-ed disabled">Paste</a></li>
                                                            <li><a class="rename fil-ed disabled">Rename</a></li>
                                                            <li><a class="new fil-ed" data-toggle="modal" data-target="#modalUploadFile" title="new file">New</a></li>
                                                            <li><a class="delete fil-ed disabled file_delete" >Delete</a></li>
                                                            <li><a><i class="fa fa-share-alt fa-1x fa-styling" title="share"></i></a></li>
                                                            <span class="btn btn-primary btn-xs ta-print"><a href="/files/print" target="_blank"><i class="fa fa-styling fa-print"></i> print</a></span>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="example">
                                                <div class="myTable" style="margin-top: 10px;">
                                                    <div class="table-responsive file_table-me " id="file_table_data">
                                                        <table class="table table-striped table-bordered table-hover file_Table" id="dataTables-example">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        <input type="checkbox" id="chk_head">
                                                                    </th>
                                                                    <th>Name</th>
                                                                    <th>Description</th>
                                                                    <th>Size</th>
                                                                    <th>Last modified</th>
                                                                    <th>Type</th>
                                                                    <th style="width: 8%;">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $no = 1; ?>
                                                                @foreach($files as $file)
                                                                    <tr id="{{ $file->id }}">
                                                                        <td id="fil_td" class="fil_sel">
                                                                            <input type="checkbox" class="file_chkbx" name="file_checkbox[]" id="">
                                                                        </td>
                                                                        <td><i class="fa fa-file"></i> {{ $file->name }}</td>
                                                                        <td>{{ ucfirst($file->description) }}</td>
                                                                        <td>{{ number_format($file->size / 1000000,3)}} Mb</td>
                                                                        <td>{{ date("F d, Y", intval($file->last_modified)) }}</td>
                                                                        <td>{{ $file->type }}</td>
                                                                        <td><a href="download/{{ $file->name.'.'.$file->type}}" download><i class="fa fa-download fa-1x fa-styling file_download" title="download"></i></a>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="all" aria-labelledby="profile-tab">
                                    <div class="panel panel-default">
                                        <div class="panel-heading hd-ed">
                                            <div class="row">
                                                <div class=" col-md-12">
                                                    <div class="text-center">
                                                        <ul class="fil-tp-lnk text-center">
                                                            <span class="btn btn-primary btn-xs ta-print"><a href="/files/print/all" target="_blank"><i class="fa fa-1x fa-styling fa-print"></i>print</a></span>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="example">
                                                <div class="table-responsive file_table_all " id="file_table_data">
                                                    <table class="table table-striped table-bordered table-hover file_Table" id="dataTables-example">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                        <input type="checkbox" id="chk_head">
                                                                </th>
                                                                <th>Employee Name</th>
                                                                <th>Total file Size</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 1; ?>
                                                            @foreach($employees as $employee)
                                                                <tr>
                                                                    <td id="fil_td" class="fil_sel">
                                                                        <!-- <div class="checkbox"> -->
                                                                            <input type="checkbox" class="file_chkbx" name="file_checkbox[]" id="">
                                                                        <!-- </div> -->
                                                                    </td>
                                                                    <td>{{ $employee->name }}</td>
                                                                    <td>{{ number_format($employee->files_total / 1000000, 3) }} MB</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.panel -->
            </div> <!-- /..col-lg-12 -->
        </div> <!-- /.row -->

        <div class="modal fade" id="modalFileShare" tabindex="-1" role="dialog" aria-labelledby="modalUploadFileLabel" >
            <div class="modal-dialog animated fadeInRight" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalUploadFileLabel">Send file to......</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered table-condensed">
                                <tbody>
                                    <?php $no = 1; $i=0; $po = []; ?>
                                    @foreach($employees as $value)
                                        @if(!in_array($value->id, $po))
                                            <?php $po[$no] = $value->id ?>
                                            <tr id="{{$value->id}}">
                                                <td id="fil_td"><input type="checkbox" class="file_user_chkbx"></td>
                                                <td>{{ $value->name }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="fileShare">Send <i class="fa fa-send"></i></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalUploadFile" tabindex="-1" role="dialog" aria-labelledby="modalUploadFileLabel" >
            <div class="modal-dialog animated fadeInRight" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalUploadFileLabel">Upload new file</h4>
                    </div>
                    <div class="row display_message">
                        <div class="col-md-12 alert alert-success">
                            <div class="alertMessage">
                                <!-- Display data messages -->Data has successfully been deleted.
                            </div>
                        </div>
                    </div>
                    <form method="post" enctype="multipart/form-data" class="form-horizontal" id="fileForm">
                        <div class="modal-body">
                            {{ csrf_field () }}
                            <input type="hidden" name="action_type" id="action_type" value="">
                            <input type="hidden" name="file_id" id="file_id" value="">
                            <div class="form-group">
                                <label for="file_name" class="control-label col-sm-3">File name</label>
                                <span class="error imageErr hidden"></span>
                                <div class="col-sm-9">
                                    <input type="file" id="uploadImage" name="uploadImage[]" multiple>
                                    <div id="image_preview"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file_name" class="control-label col-sm-3">Description</label>
                                <span class="error descErr hidden"></span>
                                <div class="col-sm-9">
                                    <textarea name="description" id="description" class="form-control" cols="30" rows="5"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" id="fileSave" value="Upload File">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
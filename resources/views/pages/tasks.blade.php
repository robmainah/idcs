    @extends('layouts.master')

    @section('content')
    <div id="page-wrapper">
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="row display_message">
                    <div class="col-md-12 alert alert-success">
                        <div class="alertMessage">
                            <!-- Display data messages -->Data has successfully been deleted.
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-left: 0px;">
                    <div class="col-md-8x col-md-offsext-2">
                        <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                            <ul id="myTabs" class="nav nav-tabs nav-pills" role="tablist">
                                <li role="presentation" class=""><a href="#sent" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Sent</a></li>
                                <li role="presentation" class="active"><a href="#all" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Received</a></li>
                            </ul>

                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade" id="sent" aria-labelledby="home-tab">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 ">
                                                    <h2 class="page-header pg-hed">Tasks</h2>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="pull-right tab-pull-right text-center">
                                                        <span class="btn btn-primary btn-xs ta-print">
                                                            <a href="/tasks/print" target="_blank"><i class="fa fa-styling fa-print"></i> print</a>
                                                        </span>
                                                        <span class="plus fa-styl" data-toggle="modal" data-target="#addTask">
                                                            <i class="fa fa-plus fa-1x fa-styling task_add" title="new department"></i>
                                                        </span>
                                                            <!-- <span class="fa-styl"><i class="fa fa-pencil fa-1x fa-styling task_edit" title="edit"></i></span> -->
                                                        <span class="fa-styl">
                                                            <i class="fa fa-trash fa-1x fa-styling task_delete" title="delete"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="task-content">
                                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                    <?php $i = 1;?>
                                                    @foreach($tasksFrom as $value)
                                                        @if($value->complete == 0)
                                                            <div class="panel panel-default ta-xcol" id="{{ $value->id }}">
                                                                <div class="panel-heading" role="tab" id="headingOne">
                                                                    <h4 class="panel-title">
                                                                        <input type="checkbox" class="tas_li" style="margin-right: 10px;float: left;">
                                                                        <div style="width: 150px; float: left;"><a>{{ ucFirst($value->userTo->name) }}</a></div>
                                                                        <span title="incomplete"><i class="fa fa-styling fa-ta-sta-unco fa-ta-sta fa-times"></i></span>
                                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>" aria-expanded="false" aria-controls="collapse<?php echo $i ?>" id="{{$value->id}}"><span class="ta-sub"><?php if(strlen($value->description) > 200){ echo  substr($value->description, 0, 100)." .........."; } else { echo $value->description; } ?></span>
                                                                        </a>
                                                                        <span class="pull-right ta-date">{{ date("F d, Y H:i", strtotime($value->updated_at)) }}</span>
                                                                    </h4>
                                                                </div>
                                                                <div id="collapse<?php echo $i ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                                    <div class="panel-body task-body" style="line-height: 2;font-family: sarif;height: 220px">
                                                                        {{ $value->description }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="panel panel-default xtsa-col" id="{{ $value->id }}">
                                                                <div class="panel-heading" role="tab" id="headingOne">
                                                                    <h4 class="panel-title">
                                                                        <input type="checkbox" class="tas_li" style="margin-right: 10px;float: left;">
                                                                        <div style="width: 150px; float: left;"><a>{{ ucFirst($value->userTo->name) }}</a></div>
                                                                        <span title="complete"><i class="fa fa-styling fa-ta-sta-com fa-ta-sta fa-check"></i></span>
                                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>" aria-expanded="false" aria-controls="collapse<?php echo $i ?>" id="{{$value->id}}"><span class="ta-sub"><?php if(strlen($value->description) > 100){ echo  substr($value->description, 0, 100)." ....."; } else { echo $value->description; } ?>
                                                                        </span></a>
                                                                        <span class="pull-right ta-date">{{ date("F d, Y H:i", strtotime($value->updated_at)) }}</span>
                                                                    </h4>
                                                                </div>
                                                                <div id="collapse<?php echo $i ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                                    <div class="panel-body task-body" style="line-height: 2;font-family: sarif;height: 220px">
                                                                        {{ $value->description }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <?php $i = $i + 1 ?>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div role="tabpanel" class="tab-pane fade active in" id="all" aria-labelledby="profile-tab">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 ">
                                                    <h2 class="page-header pg-hed">Tasks</h2>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="pull-right tab-pull-right text-center">
                                                        <span class="btn btn-primary btn-xs ta-print">
                                                            <a href="/tasks/print" target="_blank"><i class="fa fa-styling fa-print"></i> print</a>
                                                        </span>
                                                        <span class="plus fa-styl" data-toggle="modal" data-target="#addTask">
                                                            <i class="fa fa-plus fa-1x fa-styling task_add" title="new department"></i>
                                                        </span>
                                                            <!-- <span class="fa-styl"><i class="fa fa-pencil fa-1x fa-styling task_edit" title="edit"></i></span> -->
                                                        <span class="fa-styl">
                                                            <i class="fa fa-trash fa-1x fa-styling task_delete" title="delete"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                                <div class="task-content" id="sent_messages">
                                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                        <?php $i = 1000;?>
                                                        @foreach($tasksTo as $value)
                                                            @if($value->complete == 0)
                                                                <div class="panel panel-default ta-xcol" id="{{ $value->id }}">
                                                                    <div class="panel-heading" role="tab" id="headingOne">
                                                                        <h4 class="panel-title">
                                                                            <input type="checkbox" class="tas_li" style="margin-right: 10px;float: left;">
                                                                        <div style="width: 150px; float: left;"><a>{{ ucFirst($value->user->name) }}</a></div>
                                                                            <span title="incomplete"><i class="fa fa-styling fa-ta-sta-unco fa-ta-sta fa-times"></i></span>
                                                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>" aria-expanded="false" aria-controls="collapse<?php echo $i ?>" id="{{$value->id}}"><span class="ta-sub"><?php if(strlen($value->description) > 200){ echo  substr($value->description, 0, 100)." .........."; } else { echo $value->description; } ?></span></a>
                                                                            <span class="pull-right ta-date">{{ date("F d, Y H:i", strtotime($value->updated_at)) }}</span>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapse<?php echo $i ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                                        <div class="panel-body task-body" style="line-height: 2;font-family: sarif;height: 220px">
                                                                            {{ $value->description }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="panel panel-default xtsa-col" id="{{ $value->id }}">
                                                                    <div class="panel-heading" role="tab" id="headingOne">
                                                                        <h4 class="panel-title">
                                                                            <input type="checkbox" class="tas_li" style="margin-right: 10px;float: left;">
                                                                        <div style="width: 150px; float: left;"><a>{{ ucFirst($value->userTo->name) }}</a></div>
                                                                            <span title="complete"><i class="fa fa-styling fa-ta-sta-com fa-ta-sta fa-check"></i></span>
                                                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>" aria-expanded="false" aria-controls="collapse<?php echo $i ?>" id="{{$value->id}}"><span class="ta-sub"><?php if(strlen($value->description) > 100){ echo  substr($value->description, 0, 100)." ....."; } else { echo $value->description; } ?>
                                                                            </span></a>
                                                                            <span class="pull-right ta-date">{{ date("F d, Y H:i", strtotime($value->updated_at)) }}</span>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapse<?php echo $i ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                                        <div class="panel-body task-body" style="line-height: 2;font-family: sarif;height: 220px">
                                                                            {{ $value->description }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <?php $i = $i + 1 ?>
                                                        @endforeach
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /.panel -->
        </div>
    <!-- /.col-lg-12 -->
    </div>
<!-- /.row -->
<!-- Modal -->
<div class="modal fade " id="addTask" tabindex="-1" role="dialog" aria-labelledby="modalTasksLabel" >
    <div class="modal-dialog animated fadeInLeft" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalTasksLabel">Add new tasks</h4>
            </div>
        </ul>
        <form action="/tasks" class="form-horizontal tasksForm" method="post" enctype="multipart/form-data" id="dep-form">
            {{ csrf_field () }}
            <input type="hidden" name="action_type" id="action_type" value="">
            <input type="hidden" name="task_id" id="task_id" value="">
            <div class="modal-body">
                <!-- <div class="form-group">
                    <label for="task_subject" class="control-label col-sm-3 prj-title"> Task subject</label>
                    <div class="col-sm-9">
                        <span class="error task_subject_error hidden"></span>
                        <input type="text" name="task_subject" class="form-control" id="task_subject" autofocus>
                    </div>
                </div> -->
                <div class="form-group">
                    <label for="projoMembers" class="control-label  col-sm-3">Send to</label>
                    <div class="col-sm-9">
                        <a class="proj-ad-mem" id="projoMembers" name="projoMembers">Choose employee.....</a>
                        <span class="taskMembersError error hidden"></span>
                        <textarea class="form-control" name="task-disp-mem" id="task-disp-mem" rows="7" disabled></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="task_desc" class="control-label col-sm-3">Text</label>
                    <div class="col-sm-9">
                        <span class="error task_desc_error hidden"></span>
                        <textarea name="task_desc" id="task_desc" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveTasks" value="add-main">Add Task <i class="fa fa-send"></i></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<div class="modal fade" id="project_add_members" tabindex="-1" role="dialog" aria-labelledby="modalProjMembersView" >
    <div class="modal-dialog animated fadeInLeft" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalProjMembersView">Choose members to add to project</h4>
                <button class="btn btn-default btn-sm md-edit" data-dismiss="modal">Close</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row sp-se">
                        <span>Filter by department</span>
                        <select name="filtMemByDept" id="filtMemByDept">
                            <option value="all">All departments</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pr-me">
                            <ul class="ta-new-emp">
                                <span><strong>Name</strong></span>
                                @foreach($users as $user)
                                    <li id="{{ $user->id }}" onclick="selectLink(this)"><a><input class="task-check" type="checkbox" > <span>{{ $user->name }}</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="select_members">Select Members</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
@stop
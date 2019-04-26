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
                
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="me" aria-labelledby="me-tab">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 ">
                                        <span><a class="btn btn-primary" id="inbox">Inbox</a></span>
                                        <span><a class="btn btn-default" id="sent">Sent</a></span>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="pull-right tab-pull-right text-center">
                                            <span class="btn btn-primary btn-xs ta-print"><a href="/messages/print" target="_blank"><i class="fa fa-styling fa-print"></i> print</a></span>
                                            <span class="plus fa-styl" data-toggle="modal" data-target="#addTask">
                                                <i class="fa fa-plus fa-1x fa-styling task_add" title="new department"></i></span>
                                                <!-- <span class="fa-styl"><i class="fa fa-pencil fa-1x fa-styling task_edit" title="edit"></i></span> -->
                                                <span class="fa-styl"><i class="fa fa-trash fa-1x fa-styling mes_del task_delete" title="delete"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="task-content" id="inbox_messages">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <?php $no = 1; $i=10; $po = []; ?>
                                        @foreach($messagesTo as $value)
                                            <?php //if(!in_array($value->message_code, $po)) ?>
                                                <?php //$po[$no] = $value->message_code ?>
                                            <div class="panel panel-default ta-col mes" id="{{ $value->id }}">
                                                <div class="panel-heading" role="tab" id="headingOne">
                                                    <h4 class="panel-title">
                                                        <div class="ta-bd">
                                                            <input type="checkbox" class="tas_li">
                                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>" aria-expanded="false" aria-controls="collapse<?php echo $i ?>" id="{{$value->id}}">
                                                                {{ ucFirst($value->fromUser['name']) }}
                                                            </a>
                                                        </div>
                                                        @if ($value->read_status == 0)
                                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>" aria-expanded="false" aria-controls="collapse<?php echo $i ?>" id="{{$value->id}}"><span class="ta-sub ta-new">{{ ucFirst($value->text) }}</span></a>
                                                        @else 
                                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>" aria-expanded="false" aria-controls="collapse<?php echo $i ?>" id="{{$value->id}}"><span class="ta-sub">{{ $value->text }}</span></a>
                                                        @endif
                                                        <span class="pull-right ta-date">{{ date("F d, Y H:i:s", strtotime($value->updated_at)) }}</span>
                                                    </h4>
                                                </div>
                                                <div id="collapse<?php echo $i ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                    <div class="panel-body task-body" style="line-height: 2;font-family: sarif;height: 220px">
                                                        {{ $value->text }}
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $i = $i + 1 ?>
                                            <?php //endif ?>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="task-content hidden" id="sent_messages">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <?php $no = 1; $i=0; //$po = []; ?>
                                        @foreach($messagesFrom as $value)
                                            <?php //if(!in_array($value->message_code, $po)) ?>
                                                <?php //$po[$no] = $value->message_code ?>
                                            <div class="panel panel-default ta-col" id="{{ $value->id }}">
                                                <div class="panel-heading" role="tab" id="headingOne">
                                                    <h4 class="panel-title">
                                                        <div class="ta-bd">
                                                            <input type="checkbox" class="tas_li meso_del">
                                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>" aria-expanded="false" aria-controls="collapse<?php echo $i ?>" id="{{$value->id}}">
                                                                {{ ucFirst($value->toUser['name']) }} 
                                                            </a>
                                                        </div>
                                                        @if ($value->read_status == 0)
                                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>" aria-expanded="false" aria-controls="collapse<?php echo $i ?>" id="{{$value->id}}"><span class="ta-sub ">{{ ucFirst($value->text) }}</span></a>
                                                        @else 
                                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>" aria-expanded="false" aria-controls="collapse<?php echo $i ?>" id="{{$value->id}}"><span class="ta-sub">{{ $value->text }}</span></a>
                                                        @endif
                                                        <span class="pull-right ta-date">{{ date("F d, Y H:i:s", strtotime($value->updated_at)) }}</span>
                                                    </h4>
                                                </div>
                                                <div id="collapse<?php echo $i ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                    <div class="panel-body task-body" style="line-height: 2;font-family: sarif;height: 220px">
                                                        {{ $value->text }}
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $i = $i + 1 ?>
                                            <?php //endif ?>
                                        @endforeach
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
                <h4 class="modal-title" id="modalTasksLabel">New message</h4>
            </div>
        </ul>
        <form action="/tasks" class="form-horizontal tasksForm" method="post" enctype="multipart/form-data" id="dep-form">
            {{ csrf_field () }}
            <input type="hidden" name="action_type" id="action_type" value="">
            <input type="hidden" name="task_id" id="task_id" value="">
            <input type="hidden" id="meso" value="messages">
            <div class="modal-body">
                <div class="form-group">
                    <label for="projoMembers" class="control-label  col-sm-3">Send to</label>
                    <div class="col-sm-9">
                        <a class="proj-ad-mem" id="projoMembers" name="projoMembers">Choose employee.....</a>
                        <span class="messageMembersError error hidden"></span>
                        <textarea class="form-control" name="task-disp-mem" id="task-disp-mem" rows="7" disabled></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="task_desc" class="control-label col-sm-3">Text</label>
                    <div class="col-sm-9">
                        <span class="error message_text_error hidden"></span>
                        <textarea name="task_desc" id="text" class="form-control" cols="30" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveTasks" value="add-main">Send message <i class="fa fa-send"></i></button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
</div>

<div class="modal fade" id="project_add_members" tabindex="-1" role="dialog" aria-labelledby="modalProjMembersView" >
    <div class="modal-dialog animated fadeInLeft" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalProjMembersView">Choose members to send message</h4>
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
                <button type="button" class="btn btn-primary messages" id="select_members">Select Members</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
@stop
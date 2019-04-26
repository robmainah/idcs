    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">IDCS</a>
            <span id="menu-toggle">
                <i class="fa fa-2x fa-align-left"></i>
            </span>
        </div> <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    @foreach($messages as $value)
                        <li>
                            <a href="tasks">
                                <div>
                                    <p>
                                        <strong>{{ ucFirst($value->toUser['name']) }}</strong>
                                        <br>
                                        <span class="pull-right text-muted">
                                            <em>{{ \Carbon\Carbon::parse($value->updated_at)->diffForHumans() }}</em>
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <?php if(strlen($value->text) > 50){ echo  substr($value->text, 0, 50)." ....."; } else { echo $value->text; } ?>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                    @endforeach
                    <li>
                        <a class="text-center" href="messages">
                            <strong>Read All Messages</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul> <!-- /.dropdown-messages -->
            </li> <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="tasks/dropdown">
                    <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-tasks">
                    <?php $i = 1; ?>
                    @foreach($navTasks as $value)
                        <li>
                            <a href="tasks">
                                <div>
                                    <p>
                                        <strong>Task {{ $i++ }}</strong>
                                        <br>
                                        <span class="pull-right text-muted"></span>
                                    </p>
                                </div>
                                <div>
                                    <?php if(strlen($value->description) > 80){ echo  substr($value->description, 0, 80)." ....."; } else { echo $value->description; } ?>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                    @endforeach
                    <li>
                        <a class="text-center" href="tasks">
                            <strong>See All Tasks</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>

                </ul> <!-- /.dropdown-tasks -->
            </li> <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <img src="{{asset('images/1.jpg')}}" alt="" class="img-circle" width="50px">
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-fw"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul> <!-- /.dropdown-user -->
            </li> <!-- /.dropdown -->
                @if (Auth::check())
                    <li>{{ Auth::user()->name }} </li>
                @endif
        </ul> <!-- /.navbar-top-links -->
    </nav>
<div class="navbar-default sidebar" id="sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        
        <ul class="nav in" id="side-menu">
            <li>
                <h3 class="text-center">DASHBOARD</h3>
            </li>
            <li>
                <a href="/tasks"><i class="fa fa-bar-chart-o fa-fw"></i> Tasks</a>
            </li>
            <li>
                <a href="/messages"><i class="fa fa-edit fa-fw"></i> Messages</a>
            </li>
            <li class="">
                <a href="/files"><i class="fa fa-table fa-fw"></i> Files</a>
            </li>
            @if(Auth::user()->role == '1')
                <li>
                    <a href="/departments"><i class="fa fa-table fa-fw"></i> Departments </a>
                </li>
            @endif
            @if(Auth::user()->role == '1')
                <li>
                    <a href="/employees"><i class="fa fa-users fa-fw"></i> Employees</a>
                </li>
            @endif
        </ul>
    </div>
</div>
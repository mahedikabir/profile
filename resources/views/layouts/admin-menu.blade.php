<!--- Sidemenu -->
<div id="sidebar-menu">
    <ul>
        <li class="text-muted menu-title">Navigation</li>

        <li>
            <a href="{{route('dashboard.index')}}" class="waves-effect"><i class="mdi mdi-view-dashboard"></i>
                <span> Dashboard </span> </a>
        </li>

        <li>
            <a href="{{route('post.index')}}" class="waves-effect"><i class="fa fa-users"></i>
                <span> Post </span>
            </a>
        </li>


        <li>
            <a href="{{route('admin.index')}}" class="waves-effect"><i class="fa fa-users"></i>
                <span> Admins </span>
            </a>
        </li>

        <li>
            <a href="{{route('settings.index')}}" class="waves-effect"><i class="fa fa-cogs"></i>
                <span> Settings </span> </a>
        </li>

    </ul>
    <div class="clearfix"></div>
</div>

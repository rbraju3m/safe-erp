<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          
          <img src="{{URL::to('')}}/uploads/member/{{Auth::user()->image_link}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">

          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header" style="text-align: center;
font-size: 20px;
font-weight: bold;
color: #d56f6f;">SAFE MENU</li>


        <li>
          <a href=" {{ route('admin-dashboard') }} ">
            <i class="fa fa-th"></i> <span>SAFE Dashboard</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li class="treeview">
            <a href="#">
              <i class="fa fa-user-circle-o" aria-hidden="true"></i>
              <span>Member</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
            @if (Auth::user()->type == 'Admin')
              <li><a href="{{route('admin.member.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Member</a></li>
            @endif

            <li><a href="{{route('admin.member.index')}}"><i class="fa fa-list-ol" aria-hidden="true"></i>
Active Member </a></li>
            <li><a href="{{route('admin.member.inactive')}}"><i class="fa fa-list-ol" aria-hidden="true"></i> Inactive Member </a></li>
          </ul>
        </li>  


        <li class="treeview">
            <a href="#">
              <i class="fa fa-money" aria-hidden="true"></i>
              <span>Deposite</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
            @if (Auth::user()->type == 'Admin')
              <li><a href="{{route('admin.deposite.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Deposite</a></li>
            @endif

            <li><a href="{{route('admin.deposite.index')}}"><i class="fa fa-list-ol" aria-hidden="true"></i>
Active Deposite </a></li>
            <li><a href="{{route('admin.deposite.inactive')}}"><i class="fa fa-list-ol" aria-hidden="true"></i> Inactive Deposite </a></li>
          </ul>
        </li>    
  

        <li class="treeview">
          <a href="#">
            <i class="fa fa-rocket" aria-hidden="true"></i>
            <span>Breaking News</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.breakingnews.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i>Breaking News Add</a></li>
            <li><a href="{{route('admin.breakingnews.index')}}"><i class="fa fa-list-ol" aria-hidden="true"></i>
Breaking News List</a></li>
            <li><a href="{{route('admin.breakingnews.cancel')}}"><i class="fa fa-list-ol" aria-hidden="true"></i> Breaking News Cancel list</a></li>
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-newspaper-o"></i>
            <span>News System</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.news.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> News Add</a></li>
            <li><a href="{{route('admin.news.index')}}"><i class="fa fa-list-ol" aria-hidden="true"></i>
News List</a></li>
            <li><a href="{{route('admin.news.cancel.list')}}"><i class="fa fa-list-ol" aria-hidden="true"></i> News Cancel list</a></li>
          </ul>
        </li>


        


         <li class="treeview">
          <a href="#">
            <i class="fa fa-tags"></i>
            <span>Tag System</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.tag.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tag Add</a></li>
            <li><a href="{{route('admin.tag.index')}}"><i class="fa fa-list-ol" aria-hidden="true"></i>
Tag List</a></li>
            <li><a href="{{route('admin.tag.cancel')}}"><i class="fa fa-list-ol" aria-hidden="true"></i>Tag Cancel list</a></li>
          </ul>
        </li>



        <li class="treeview">
          <a href="#">
            <i class="fa fa-compass"></i>
            <span>Menu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.menu.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Menu Add</a></li>

            <li><a href="{{route('admin.menu.index')}}"><i class="fa fa-list-ol" aria-hidden="true"></i>
Menu List</a></li>

            <li><a href="{{route('admin.menu.cancellist')}}"><i class="fa fa-list-ol" aria-hidden="true"></i>Menu Cancel list</a></li>
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-snowflake-o"></i>
            <span>Menu Item</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.menuitem.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Menu Item Add</a></li>

            <li><a href="{{route('admin.menuitem.index')}}"><i class="fa fa-list-ol" aria-hidden="true"></i>
Menu item List</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
            	<a href="{{route('admin.frontvedio.index')}}"><i class="fa fa-video-camera" aria-hidden="true"></i> Frontend Video Section</a>
            </li>

            
          </ul>
        </li>
     
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
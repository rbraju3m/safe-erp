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
        <?php
          $name = Auth::user()->name;
          $name = substr($name, 0, strrpos($name, ' '));
        ?>
        
        <?php
          $current_year = date("Y");
        ?>
        <li>
          <a href=" {{route('admin.deposite.intotal',$current_year)}} ">
            <i class="fa fa-calculator"></i> <span>Calculate</span>
            <span class="pull-right-container">
              <small class="label pull-top bg-blue">In Total</small>
            </span>
          </a>
        </li>


        <li class="treeview">
            <a href="#">
              <i class="fa fa-file-word-o" aria-hidden="true"></i>
              <span>File</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
            {{-- @if (Auth::user()->type == 'Admin') --}}
              <li><a href="{{route('admin.file.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add File</a></li>
            {{-- @endif --}}

            <li><a href="{{route('admin.file.index')}}"><i class="fa fa-list-ol" aria-hidden="true"></i>
Active File </a></li>
            <li><a href="{{route('admin.file.inactive')}}"><i class="fa fa-list-ol" aria-hidden="true"></i> Inactive File </a></li>
          </ul>
        </li> 


        <li>
          <a href=" {{route('admin.password.ChangeForm')}} ">
            <i class="fa fa-unlock-alt"></i> <span>Change Password</span>
            <span class="pull-right-container">
              <small class="label pull-top bg-red">{{ $name }}</small>
            </span>
          </a>
        </li>   
     
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<aside class="main-sidebar" style="margin-top: 15px;">
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
              <span>Profit Sharing</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
            @if (Auth::user()->type == 'Admin')
              <li><a href="{{route('admin_profit_sharing')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i>Profit Sharing </a></li>
            @endif

            {{--<li><a href="{{route('admin.member.index')}}"><i class="fa fa-list-ol" aria-hidden="true"></i>
Active Member </a></li>
            <li><a href="{{route('admin.member.inactive')}}"><i class="fa fa-list-ol" aria-hidden="true"></i> Inactive Member </a></li>--}}
          </ul>
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
              <i class="fa fa-minus-square" aria-hidden="true"></i>
              <span>Expense</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
             @if (Auth::user()->type == 'Admin')
              <li><a href="{{route('admin.expense.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Expense</a></li>
            @endif

            <li><a href="{{route('admin.expense.index')}}"><i class="fa fa-list-ol" aria-hidden="true"></i>
Active Expense </a></li>
            <li><a href="{{route('admin.expense.inactive')}}"><i class="fa fa-list-ol" aria-hidden="true"></i> Inactive Expense </a></li>
          </ul>
        </li>


        <li class="treeview">
            <a href="#">
              <i class="fa fa-university" aria-hidden="true"></i>
              <span>Bank Profit / Ex </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
             @if (Auth::user()->type == 'Admin')
              <li><a href="{{route('admin.bank.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Bank Profit / Ex</a></li>
             @endif
            <li><a href="{{route('admin.bank.index')}}"><i class="fa fa-list-ol" aria-hidden="true"></i>
Active Bank Profit / Ex </a></li>
            <li><a href="{{route('admin.bank.inactive')}}"><i class="fa fa-list-ol" aria-hidden="true"></i> Inactive Bank Profit / Ex </a></li>
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


         <li class="treeview">
            <a href="#">
              <i class="fa fa-picture-o" aria-hidden="true"></i>
              <span>Gallery</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
            {{-- @if (Auth::user()->type == 'Admin') --}}
              <li><a href="{{route('admin.gallery.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Gallery</a></li>
            {{-- @endif --}}

            <li><a href="{{route('admin.gallery.index')}}"><i class="fa fa-list-ol" aria-hidden="true"></i>
Active Gallery </a></li>
            <li><a href="{{route('admin.gallery.inactive')}}"><i class="fa fa-list-ol" aria-hidden="true"></i> Inactive Gallery </a></li>
          </ul>
        </li>





        <li>
          <a href=" {{route('admin.password.ChangeForm')}} ">
            <i class="fa fa-unlock-alt"></i> <span>Change Password</span>
            <span class="pull-right-container">
              <small class="label pull-top bg-red"></small>
            </span>
          </a>
        </li>


        <li>
          <a href=" {{route('logout')}} " onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i> <span>Logout</span>
            <span class="pull-right-container">
              <small class="label pull-top bg-red">{{ $name }}</small>
            </span>
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

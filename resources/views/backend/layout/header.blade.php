<header class="main-header">

    <!-- Logo -->
    <a href="{{route('admin-dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SAFE</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SAFE</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
        <span class="step_text" style="">Step for Advanced Future Entrepreneurship</span>

      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{URL::to('')}}/uploads/member/{{Auth::user()->image_link}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{URL::to('')}}/uploads/member/{{Auth::user()->image_link}}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->name }}
                  <small>Member since {{ Auth::user()->created_at  }}</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a class="btn btn-default btn-flat" title="View Member" member-id="{{ $values->id }}" id="view_member" style="border: 1px solid;padding: 2px 5px;cursor: pointer;" data-href="{{ route('admin.member.show', Auth::user()->user_id) }}" >Profile</a>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sign out') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                  
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
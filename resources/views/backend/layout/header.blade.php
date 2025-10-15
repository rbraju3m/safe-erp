<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('admin-dashboard') }}" class="logo">
        <span class="logo-mini"><b>SAFE</b></span>
        <span class="logo-lg"><b>SAFE</b></span>
    </a>

    <!-- Navbar -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle -->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <span class="step_text">Step for Advanced Future Entrepreneurship</span>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img
                            src="{{ Auth::user()->image_link ? asset('uploads/member/' . Auth::user()->image_link) : asset('images/default-user.png') }}"
                            class="user-image"
                            alt="User Image"
                        >
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>

                    <ul class="dropdown-menu">
                        <!-- User image in menu -->
                        <li class="user-header">
                            <img
                                src="{{ Auth::user()->image_link ? asset('uploads/member/' . Auth::user()->image_link) : asset('images/default-user.png') }}"
                                class="img-circle"
                                alt="User Image"
                            >
                            <p>
                                {{ Auth::user()->name }}<br>
                                <small>Member since {{ Auth::user()->created_at ? Auth::user()->created_at->format('M d, Y') : '' }}</small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a
                                    class="btn btn-default btn-flat"
                                    title="View Profile"
                                    data-href="{{ route('admin.member.show', Auth::user()->id) }}"
                                >
                                    Profile
                                </a>
                            </div>

                            <div class="pull-right">
                                <a
                                    class="btn btn-default btn-flat"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                >
                                    {{ __('Sign out') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- Control Sidebar Toggle -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

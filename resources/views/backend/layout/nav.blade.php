<aside class="main-sidebar" style="margin-top: 15px;">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ URL::to('') }}/uploads/member/{{ Auth::user()->image_link }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header text-center" style="font-size: 20px; font-weight: bold; color: #d56f6f;">
                SAFE MENU
            </li>

            {{-- Dashboard --}}
            <li class="{{ request()->routeIs('admin-dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin-dashboard') }}">
                    <i class="fa fa-th"></i> <span>SAFE Dashboard</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
            </li>

            {{-- Profit Sharing --}}
            <li class="treeview {{ request()->routeIs('admin_profit_sharing*') ? 'menu-open active' : '' }}">
                <a href="#">
                    <i class="fa fa-user-circle-o"></i> <span>Profit Sharing</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @if (Auth::user()->type == 'Admin')
                        <li><a href="{{ route('admin_profit_sharing') }}"><i class="fa fa-plus-circle"></i> Add Profit Sharing</a></li>
                    @endif
                    <li><a href="{{ route('admin_profit_sharing_index') }}"><i class="fa fa-list-ol"></i> Profit Sharing Index</a></li>
                    <li><a href="{{ route('admin.member.index') }}"><i class="fa fa-list-ol"></i> Active Member</a></li>
                    <li><a href="{{ route('admin.member.inactive') }}"><i class="fa fa-list-ol"></i> Inactive Member</a></li>
                </ul>
            </li>

            {{-- Member --}}
            <li class="treeview {{ request()->routeIs('admin.member.*') ? 'menu-open active' : '' }}">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Member</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @if (Auth::user()->type == 'Admin')
                        <li><a href="{{ route('admin.member.create') }}"><i class="fa fa-plus-circle"></i> Add Member</a></li>
                    @endif
                    <li><a href="{{ route('admin.member.index') }}"><i class="fa fa-list-ol"></i> Active Member</a></li>
                    <li><a href="{{ route('admin.member.inactive') }}"><i class="fa fa-list-ol"></i> Inactive Member</a></li>
                </ul>
            </li>

            {{-- Deposit --}}
            <li class="treeview {{ request()->routeIs('admin.deposit.*') ? 'menu-open active' : '' }}">
                <a href="#">
                    <i class="fa fa-money"></i> <span>Deposit</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @if (Auth::user()->type == 'Admin')
                        <li><a href="{{ route('admin.deposit.create') }}"><i class="fa fa-plus-circle"></i> Add Deposit</a></li>
                    @endif
                    <li><a href="{{ route('admin.deposit.index') }}"><i class="fa fa-list-ol"></i> Active Deposit</a></li>
                    <li><a href="{{ route('admin.deposit.inactive') }}"><i class="fa fa-list-ol"></i> Inactive Deposit</a></li>
                </ul>
            </li>

            {{-- Expense --}}
            <li class="treeview {{ request()->routeIs('admin.expense.*') ? 'menu-open active' : '' }}">
                <a href="#">
                    <i class="fa fa-minus-square"></i> <span>Expense</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @if (Auth::user()->type == 'Admin')
                        <li><a href="{{ route('admin.expense.create') }}"><i class="fa fa-plus-circle"></i> Add Expense</a></li>
                    @endif
                    <li><a href="{{ route('admin.expense.index') }}"><i class="fa fa-list-ol"></i> Active Expense</a></li>
                    <li><a href="{{ route('admin.expense.inactive') }}"><i class="fa fa-list-ol"></i> Inactive Expense</a></li>
                </ul>
            </li>

            {{-- Bank --}}
            <li class="treeview {{ request()->routeIs('admin.bank.*') ? 'menu-open active' : '' }}">
                <a href="#">
                    <i class="fa fa-university"></i> <span>Bank Profit / Ex</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @if (Auth::user()->type == 'Admin')
                        <li><a href="{{ route('admin.bank.create') }}"><i class="fa fa-plus-circle"></i> Add Bank Profit / Ex</a></li>
                    @endif
                    <li><a href="{{ route('admin.bank.index') }}"><i class="fa fa-list-ol"></i> Active Bank Profit / Ex</a></li>
                    <li><a href="{{ route('admin.bank.inactive') }}"><i class="fa fa-list-ol"></i> Inactive Bank Profit / Ex</a></li>
                </ul>
            </li>

            {{-- Calculate --}}
            @php $current_year = date('Y'); @endphp
            <li class="{{ request()->routeIs('admin.deposit.intotal') ? 'active' : '' }}">
                <a href="{{ route('admin.deposit.intotal', $current_year) }}">
                    <i class="fa fa-calculator"></i> <span>Calculate</span>
                    <span class="pull-right-container">
                        <small class="label pull-top bg-blue">In Total</small>
                    </span>
                </a>
            </li>

            {{-- File --}}
            <li class="treeview {{ request()->routeIs('admin.file.*') ? 'menu-open active' : '' }}">
                <a href="#">
                    <i class="fa fa-file-word-o"></i> <span>File</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.file.create') }}"><i class="fa fa-plus-circle"></i> Add File</a></li>
                    <li><a href="{{ route('admin.file.index') }}"><i class="fa fa-list-ol"></i> Active File</a></li>
                    <li><a href="{{ route('admin.file.inactive') }}"><i class="fa fa-list-ol"></i> Inactive File</a></li>
                </ul>
            </li>

            {{-- Gallery --}}
            <li class="treeview {{ request()->routeIs('admin.gallery.*') ? 'menu-open active' : '' }}">
                <a href="#">
                    <i class="fa fa-picture-o"></i> <span>Gallery</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.gallery.create') }}"><i class="fa fa-plus-circle"></i> Add Gallery</a></li>
                    <li><a href="{{ route('admin.gallery.index') }}"><i class="fa fa-list-ol"></i> Active Gallery</a></li>
                    <li><a href="{{ route('admin.gallery.inactive') }}"><i class="fa fa-list-ol"></i> Inactive Gallery</a></li>
                </ul>
            </li>

            {{-- Change Password --}}
            <li class="{{ request()->routeIs('admin.member.password.change.form') ? 'active' : '' }}">
                <a href="{{ route('admin.member.password.change.form') }}">
                    <i class="fa fa-unlock-alt"></i> <span>Change Password</span>
                </a>
            </li>

            {{-- Logout --}}
            @php
                use Illuminate\Support\Str;
                $name = Str::beforeLast(Auth::user()->name, ' ');
            @endphp
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
</aside>

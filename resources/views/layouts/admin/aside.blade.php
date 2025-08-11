<aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all">
    <div class="sidebar-header d-flex align-items-center justify-content-start">
        <a href="#" class="navbar-brand">
            <div class="logo-main">
                <div class="logo-normal">
                    <img src="{{ asset('./assets/images/small-logo.png') }}" style="width:30px" class="img-fluid" alt="KPoint Logo">
                </div>
            </div>
            <h4 class="logo-title">KPOINT</h4>
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </i>
        </div>
    </div>
    <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list">
            <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                <!-- Admin Section -->
                <li class="nav-item static-item">
                    <a class="nav-link static-item disabled" href="#" tabindex="-1">
                        <span class="default-icon">Admin Panel</span>
                        <span class="mini-icon">A</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <span class="item-name">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.users') }}" class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <span class="item-name">Users</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.reps') }}" class="nav-link {{ Request::is('admin/reps') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <span class="item-name">Reps</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.plans') }}" class="nav-link {{ Request::is('admin/plans') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-list"></i>
                        <span class="item-name">Plans</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.transactions') }}" class="nav-link {{ Request::is('admin/transactions') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-retweet"></i>
                        <span class="item-name">Transactions</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.usersWallet') }}" class="nav-link {{ Request::is('admin/usersWallet') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-wallet"></i>
                        <span class="item-name">Users Wallet</span>
                    </a>
                </li>
                
                
                <li class="nav-item">
    <a href="{{ route('admin.withdrawal') }}" class="nav-link {{ Request::is('admin/withdrawal') ? 'active' : '' }}">
        <i class="nav-icon fa fa-money-bill-wave"></i>
        <span class="item-name">Withdrawal Request</span>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.manualfunding') }}" class="nav-link {{ Request::is('admin/manualfunding') ? 'active' : '' }}">
        <i class="nav-icon fa fa-hand-holding-usd"></i>
        <span class="item-name">Manual Fund Request</span>
    </a>
</li>



                <li class="nav-item">
                    <a href="{{ route('admin.profile') }}" class="nav-link {{ Request::is('admin/profile') ? 'active' : '' }}">
                        <i class="far fa-user nav-icon"></i>
                        <span class="item-name">Profile</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#logout-modal">
                        <i class="fa fa-power-off nav-icon"></i>
                        <span class="item-name">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="sidebar-footer"></div>
</aside>
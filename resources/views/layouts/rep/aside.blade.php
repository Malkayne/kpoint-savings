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
                <li class="nav-item static-item">
                    <a class="nav-link static-item disabled" href="#" tabindex="-1">
                        <span class="default-icon">Representative Panel</span>
                        <span class="mini-icon">R</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rep.dashboard') }}" class="nav-link {{ Request::is('rep/dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <span class="item-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rep.users') }}" class="nav-link {{ Request::is('rep/users') ? 'active' : '' }}">
                        <i class="fa fa-users nav-icon"></i>
                        <span class="item-name">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rep.plans') }}" class="nav-link {{ Request::is('rep/plans') ? 'active' : '' }}">
                        <i class="fa fa-list nav-icon"></i>
                        <span class="item-name">Plans</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rep.transactions') }}" class="nav-link {{ Request::is('rep/transactions') ? 'active' : '' }}">
                        <i class="fa fa-retweet nav-icon"></i>
                        <span class="item-name">Transactions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rep.usersWallet') }}" class="nav-link {{ Request::is('rep/usersWallet') ? 'active' : '' }}">
                        <i class="fa fa-wallet nav-icon"></i>
                        <span class="item-name">Users Wallet</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rep.profile') }}" class="nav-link {{ Request::is('rep/profile') ? 'active' : '' }}">
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
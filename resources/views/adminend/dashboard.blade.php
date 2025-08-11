@extends('layouts.admin.app')
@section('title', 'Dashboard')
@section('content-header', 'Dashboard')
@section('content-header-description', 'Welcome to KPOINT SAVINGS Admin Dashboard Panel')
@section('content')

<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row row-cols-1">
                <div class="overflow-hidden d-slider1 ">
                    <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="600">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-info">
                                        <i class="bi bi-cash-coin fs-2 text-info"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Net Flow</p>
                                        <h4 class="counter">₦{{ number_format($netFlow,2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-primary">
                                        <i class="bi bi-people fs-2 text-primary"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Users</p>
                                        <h4 class="counter">{{ $totalUsers }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-info">
                                        <i class="bi bi-person-badge fs-2 text-info"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Reps</p>
                                        <h4 class="counter">{{ $totalReps }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-success">
                                        <i class="bi bi-graph-up-arrow fs-2 text-success"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Plans</p>
                                        <h4 class="counter">{{ $totalPlans }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-warning">
                                        <i class="bi bi-person-check fs-2 text-warning"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Active Users</p>
                                        <h4 class="counter">{{ $activeUsers }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1100">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-danger">
                                        <i class="bi bi-person-x fs-2 text-danger"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Inactive Users</p>
                                        <h4 class="counter">{{ $inactiveUsers }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1200">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-info">
                                        <i class="bi bi-person-badge fs-2 text-info"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Active Reps</p>
                                        <h4 class="counter">{{ $activeReps }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-danger">
                                        <i class="bi bi-person-x fs-2 text-danger"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Inactive Reps</p>
                                        <h4 class="counter">{{ $inactiveReps }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1400">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-success">
                                        <i class="bi bi-graph-up-arrow fs-2 text-success"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Active Plans</p>
                                        <h4 class="counter">{{ $activePlans }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1500">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-primary">
                                        <i class="bi bi-check2-circle fs-2 text-primary"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Completed Plans</p>
                                        <h4 class="counter">{{ $completedPlans }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1600">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-danger">
                                        <i class="bi bi-x-circle fs-2 text-danger"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Broken Plans</p>
                                        <h4 class="counter">{{ $brokenPlans }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1700">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-success">
                                        <i class="bi bi-arrow-down-circle fs-2 text-success"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Credits</p>
                                        <h4 class="counter">₦{{ number_format($totalCredits,2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1800">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-danger">
                                        <i class="bi bi-arrow-up-circle fs-2 text-danger"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Debits</p>
                                        <h4 class="counter">₦{{ number_format($totalDebits,2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1900">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-info">
                                        <i class="bi bi-cash-coin fs-2 text-info"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Net Flow</p>
                                        <h4 class="counter">₦{{ number_format($netFlow,2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="2000">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-primary">
                                        <i class="bi bi-wallet2 fs-2 text-primary"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Wallet</p>
                                        <h4 class="counter">₦{{ number_format($totalWallet,2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="2100">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-success">
                                        <i class="bi bi-bar-chart-steps fs-2 text-success"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Contributions</p>
                                        <h4 class="counter">₦{{ number_format($totalContributions,2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="2200">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-info">
                                        <i class="bi bi-bar-chart-line fs-2 text-info"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Avg Contribution</p>
                                        <h4 class="counter">₦{{ number_format($avgContribution,2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="swiper-button swiper-button-next"></div>
                    <div class="swiper-button swiper-button-prev"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8 mt-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Recent Transactions</h4>
                    <a href="{{ route('admin.transactions') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="View All">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>User</th>
                                <th>Rep</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTransactions as $tx)
                                <tr>
                                    <td>{{ $tx->created_at->format('d M, Y') }}</td>
                                    <td><a href="{{ route('admin.userTransaction') }}?uid={{ $tx->user->id }}" class="fw-bold">{{ $tx->user->name ?? '-' }}</a></td>
                                    <td>{{ $tx->rep->name ?? '-' }}</td>
                                    <td><span class="badge bg-{{ $tx->type == 'credit' ? 'success' : 'danger' }}">{{ ucfirst($tx->type) }}</span></td>
                                    <td>₦{{ number_format($tx->amount,2) }}</td>
                                    <td>{{ $tx->description ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center">No recent transactions</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Recent Plans</h4>
                    <a href="{{ route('admin.plans') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="View All">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>User</th>
                                <th>Rep</th>
                                <th>Title</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPlans as $plan)
                                <tr>
                                    <td>{{ $plan->created_at->format('d M, Y') }}</td>
                                    <td>{{ $plan->user->name ?? '-' }}</td>
                                    <td>{{ $plan->rep->name ?? '-' }}</td>
                                    <td><a href="{{ route('admin.planDetails', ['plan' => $plan->id]) }}" class="fw-bold">{{ $plan->title }}</a></td>
                                    <td>₦{{ number_format($plan->amount,2) }}</td>
                                    <td><span class="badge bg-{{ $plan->status == 'active' ? 'info' : ($plan->status == 'completed' ? 'success' : 'danger') }}">{{ ucfirst($plan->status) }}</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center">No recent plans</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4 mt-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Recent Users</h4>
                    <a href="{{ route('admin.users') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="View All">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Rep</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentUsers as $user)
                                <tr>
                                    <td>{{ $user->created_at->format('d M, Y') }}</td>
                                    <td><a href="{{ route('admin.userDetails', ['user' => $user->id]) }}" class="fw-bold">{{ $user->name }}</a></td>
                                    <td><a href="{{ route('admin.repDetails', ['rep' => $user->rep->id]) }}" class="fw-bold">{{ $user->rep->name ?? '-' }}</a></td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center">No recent users</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Top Reps</h4>
                    <a href="{{ route('admin.reps') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="View All">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Users</th>
                                <th>Total User Wallet</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topReps as $rep)
                                <tr>
                                    <td><a href="{{ route('admin.repDetails', ['rep' => $rep->id]) }}" class="fw-bold">{{ $rep->name }}</a></td>
                                    <td>{{ $rep->users_count }}</td>
                                    <td>₦{{ number_format($rep->users_sum_wallet_balance,2) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center">No top reps</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Monthly Statistics</h4>
                </div>
                <div class="card-body">
                    <!-- Chart Placeholder -->
                    <div id="monthly-stats-chart" style="height: 300px;">
                        <!-- Integrate chart.js or similar here -->
                        <p class="text-center text-muted">[Monthly stats chart placeholder]</p>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection

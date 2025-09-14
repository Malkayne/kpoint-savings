@extends('layouts.users.app')
@section('title', 'Dashboard')
@section('content-header', 'Dashboard')
@section('content-header-description', 'Welcome to KPOINT SAVINGS Dashboard Panel')
@section('content')

<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row row-cols-1">
                <div class="overflow-hidden d-slider1 ">
                    <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline">

                    <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-primary">
                                        <i class="bi bi-wallet2 fs-2 text-primary"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Savings Balance</p>
                                        <h4 class="counter">₦{{ number_format($user->wallet_balance,2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>


                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-primary">
                                        <i class="bi bi-wallet2 fs-2 text-primary"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Wallet Balance</p>
                                        <h4 class="counter">₦{{ number_format($user->wallet?$user->wallet->amount:0,2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-info">
                                        <i class="bi bi-graph-up-arrow fs-2 text-info"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Active Plans</p>
                                        <h4 class="counter">{{ $activePlans }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-info">
                                        <i class="bi bi-graph-up-arrow fs-2 text-info"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Broken Plans</p>
                                        <h4 class="counter">{{ $brokenPlans }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-success">
                                        <i class="bi bi-check2-circle fs-2 text-success"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Completed Plans</p>
                                        <h4 class="counter">{{ $completedPlans }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-warning">
                                        <i class="bi bi-list-columns-reverse fs-2 text-warning"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Transactions</p>
                                        <h4 class="counter">{{ $totalTransactions }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1100">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-primary">
                                        <i class="bi bi-arrow-down-circle fs-2 text-primary"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Credits</p>
                                        <h4 class="counter">₦{{ number_format($totalCredits,2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1200">
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
                        {{-- <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="text-center circle-progress-01 circle-progress circle-progress-info">
                                        <i class="bi bi-bar-chart-steps fs-2 text-info"></i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Plan Progress</p>
                                        <h4 class="counter">{{ number_format($planProgress,1) }}%</h4>
                                    </div>
                                </div>
                            </div>
                        </li> --}}
                    </ul>
                    <div class="swiper-button swiper-button-next"></div>
                    <div class="swiper-button swiper-button-prev"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8 mt-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Recent Transactions</h4>
                    <a href="{{ route('rep.transactions') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="View All">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Plan</th>
                                <th>Rep</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTransactions as $tx)
                                <tr>
                                    <td>{{ $tx->created_at->format('d M, Y') }}</td>
                                    <td><span class="badge bg-{{ $tx->type == 'credit' ? 'success' : 'danger' }}">{{ ucfirst($tx->type) }}</span></td>
                                    <td>₦{{ number_format($tx->amount,2) }}</td>
                                    <td>{{ $tx->description ?? '-' }}</td>
                                    <td>{{ $tx->plan->title ?? '-' }}</td>
                                    <td>{{ $tx->rep->name ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center">No recent transactions</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4 mt-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Recent Contributions</h4>
                    <a href="{{ route('rep.plans') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="View All">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Plan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentContributions as $contrib)
                                <tr>
                                    <td>{{ $contrib->created_at->format('d M, Y') }}</td>
                                    <td>₦{{ number_format($contrib->amount,2) }}</td>
                                    <td>{{ $contrib->plan->title ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center">No recent contributions</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

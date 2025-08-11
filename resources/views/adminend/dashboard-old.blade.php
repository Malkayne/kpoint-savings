@extends('layouts.admin.app')
@section('title', 'Dashboard')
@section('content-header', 'Dashboard')
@section('content-header-description', 'Welcome to KPOINT SAVINGS Admin Dashboard Panel')
@section('content')

<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <!-- Card Counters -->
        <div class="col-md-12 col-lg-12 mb-4">
            <div class="row row-cols-1 row-cols-md-5 g-4">
                <div class="col">
                    <div class="card card-slide">
                        <div class="card-body text-center">
                            <div class="progress-widget">
                                <div class="progress-detail">
                                    <p class="mb-2">Total Users</p>
                                    <h4 class="counter">{{ $totalUsers }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-slide">
                        <div class="card-body text-center">
                            <div class="progress-widget">
                                <div class="progress-detail">
                                    <p class="mb-2">Total Reps</p>
                                    <h4 class="counter">{{ $totalReps }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-slide">
                        <div class="card-body text-center">
                            <div class="progress-widget">
                                <div class="progress-detail">
                                    <p class="mb-2">Total Plans</p>
                                    <h4 class="counter">{{ $totalPlans }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-slide">
                        <div class="card-body text-center">
                            <div class="progress-widget">
                                <div class="progress-detail">
                                    <p class="mb-2">Total Transactions</p>
                                    <h4 class="counter">{{ $totalTransactions }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-slide">
                        <div class="card-body text-center">
                            <div class="progress-widget">
                                <div class="progress-detail">
                                    <p class="mb-2">Total Wallet Balance</p>
                                    <h4 class="counter">₦{{ number_format($totalWallet, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Reps -->
        <div class="col-md-12 col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Top Reps (by Users Managed)</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Users</th>
                                <th>Wallet Managed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topReps as $i => $rep)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $rep->name }}</td>
                                    <td>{{ $rep->users_count }}</td>
                                    <td>₦{{ number_format($rep->wallet_balance, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="col-md-12 col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Transactions</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTransactions as $i => $transaction)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $transaction->user->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($transaction->type === 'credit')
                                            <span class="badge bg-success">Credit</span>
                                        @else
                                            <span class="badge bg-danger">Debit</span>
                                        @endif
                                    </td>
                                    <td>₦{{ number_format($transaction->amount, 2) }}</td>
                                    <td>{{ $transaction->created_at ? $transaction->created_at->format('d M Y H:i') : '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

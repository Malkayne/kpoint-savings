@extends('layouts.users.app')
@section('title', 'Wallet')
@section('content-header', 'Wallet')
@section('content-header-description', 'View your wallet balance and information')
@section('content')

<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Wallet Balance</h4>
                        </div>
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-wallet fa-3x text-primary mb-3"></i>
                                <h2 class="text-primary">₦{{ number_format($user->wallet_balance, 2) }}</h2>
                                <p class="text-muted">Available Balance</p>
                            </div>
                            
                            <div class="row text-center">
                                <div class="col-6">
                                    <h5 class="text-success">₦{{ number_format($user->transactions()->where('type', 'credit')->sum('amount'), 2) }}</h5>
                                    <small class="text-muted">Total Credits</small>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-danger">₦{{ number_format($user->transactions()->where('type', 'debit')->sum('amount'), 2) }}</h5>
                                    <small class="text-muted">Total Debits</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Wallet Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Account Number</label>
                                    <p class="mb-0">{{ $user->accNum }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Account Holder</label>
                                    <p class="mb-0">{{ $user->name }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Total Transactions</label>
                                    <p class="mb-0">{{ $user->transactions()->count() }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Last Transaction</label>
                                    <p class="mb-0">
                                        @php
                                            $lastTransaction = $user->transactions()->latest()->first();
                                        @endphp
                                        {{ $lastTransaction ? $lastTransaction->created_at->format('d M Y H:i') : 'N/A' }}
                                    </p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Active Plans</label>
                                    <p class="mb-0">{{ $user->contributionPlans()->where('status', 'active')->count() }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Completed Plans</label>
                                    <p class="mb-0">{{ $user->contributionPlans()->where('status', 'completed')->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4 class="card-title">Recent Transactions</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $recentTransactions = $user->transactions()->latest()->take(5)->get();
                                        @endphp
                                        @forelse($recentTransactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                                                <td>
                                                    <span class="badge 
                                                        @if($transaction->type === 'credit') bg-success
                                                        @else bg-danger
                                                        @endif">
                                                        {{ ucfirst($transaction->type) }}
                                                    </span>
                                                </td>
                                                <td>₦{{ number_format($transaction->amount, 2) }}</td>
                                                <td>{{ $transaction->description ?? 'N/A' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No recent transactions</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            @if($user->transactions()->count() > 5)
                                <div class="text-center mt-3">
                                    <a href="{{ route('userend.transactions') }}" class="btn btn-outline-primary btn-sm">
                                        View All Transactions
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 
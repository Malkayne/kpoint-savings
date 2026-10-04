@extends('superadmin.layouts.app')
@section('title', 'Dashboard')
@section('content-header', 'Platform dashboard')
@section('content-header-description', 'Organisations, members, and balances across the product')
@section('header-action')
    <a href="{{ route('superadmin.orgs.create') }}" class="btn btn-primary">New organisation</a>
@endsection
@section('content')
<div class="row">
    <div class="col-md-6 col-xl-4 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="progress-widget">
                    <div class="text-center circle-progress-01 circle-progress circle-progress-primary">
                        <i class="fas fa-building fs-2 text-primary"></i>
                    </div>
                    <div class="progress-detail">
                        <p class="mb-2">Organisations</p>
                        <h4 class="counter mb-0">{{ $totalOrgs }}</h4>
                        <small class="text-muted">{{ $activeOrgs }} active</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="progress-widget">
                    <div class="text-center circle-progress-01 circle-progress circle-progress-info">
                        <i class="fas fa-users fs-2 text-info"></i>
                    </div>
                    <div class="progress-detail">
                        <p class="mb-2">Members</p>
                        <h4 class="counter mb-0">{{ number_format($totalUsers) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="progress-widget">
                    <div class="text-center circle-progress-01 circle-progress circle-progress-success">
                        <i class="fas fa-user-tie fs-2 text-success"></i>
                    </div>
                    <div class="progress-detail">
                        <p class="mb-2">Reps</p>
                        <h4 class="counter mb-0">{{ number_format($totalReps) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-6 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="progress-widget">
                    <div class="text-center circle-progress-01 circle-progress circle-progress-warning">
                        <i class="fas fa-retweet fs-2 text-warning"></i>
                    </div>
                    <div class="progress-detail">
                        <p class="mb-2">Transactions</p>
                        <h4 class="counter mb-0">{{ number_format($totalTransactions) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-6 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="progress-widget">
                    <div class="text-center circle-progress-01 circle-progress circle-progress-primary">
                        <i class="fas fa-wallet fs-2 text-primary"></i>
                    </div>
                    <div class="progress-detail">
                        <p class="mb-2">Member balances</p>
                        <h4 class="counter mb-0">₦{{ number_format($totalWallet, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Organisations</h4>
        <a href="{{ route('superadmin.orgs') }}" class="btn btn-sm btn-outline-primary">View all</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Members</th>
                        <th>Reps</th>
                        <th>Transactions</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($orgs as $org)
                    <tr>
                        <td>
                            <a href="{{ route('superadmin.orgs.show', $org) }}" class="fw-bold">{{ $org->name }}</a>
                        </td>
                        <td>
                            @if($org->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif($org->status === 'suspended')
                                <span class="badge bg-danger">Suspended</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($org->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $org->users_count }}</td>
                        <td>{{ $org->reps_count }}</td>
                        <td>{{ $org->transactions_count }}</td>
                        <td class="text-end">
                            @if($org->status === 'active')
                                <form method="POST" action="{{ route('superadmin.enter-org', $org) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-primary" type="submit">Enter</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No organisations yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

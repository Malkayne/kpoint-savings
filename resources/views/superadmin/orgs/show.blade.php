@extends('superadmin.layouts.app')
@section('title', $org->name)
@section('content-header', $org->name)
@section('content-header-description', $org->slug.' · '.($org->email ?: 'No contact email'))
@section('header-action')
    <div class="d-flex gap-2">
        <a class="btn btn-light" href="{{ route('superadmin.orgs.edit', $org) }}">Edit</a>
        @if($org->status === 'active')
            <form method="POST" action="{{ route('superadmin.enter-org', $org) }}">@csrf<button class="btn btn-primary" type="submit">Enter</button></form>
            <form method="POST" action="{{ route('superadmin.orgs.suspend', $org) }}">@csrf<button class="btn btn-danger" type="submit">Suspend</button></form>
        @else
            <form method="POST" action="{{ route('superadmin.orgs.activate', $org) }}">@csrf<button class="btn btn-success" type="submit">Activate</button></form>
        @endif
    </div>
@endsection
@section('content')
<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card"><div class="card-body"><p class="mb-1 text-muted">Members</p><h4 class="mb-0">{{ $org->users_count }}</h4></div></div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card"><div class="card-body"><p class="mb-1 text-muted">Reps</p><h4 class="mb-0">{{ $org->reps_count }}</h4></div></div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card"><div class="card-body"><p class="mb-1 text-muted">Admins</p><h4 class="mb-0">{{ $org->admins_count }}</h4></div></div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card"><div class="card-body"><p class="mb-1 text-muted">Transactions</p><h4 class="mb-0">{{ $org->transactions_count }}</h4></div></div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 mb-3">
        <div class="card h-100">
            <div class="card-header"><h4 class="card-title mb-0">Details</h4></div>
            <div class="card-body">
                <p class="mb-2"><span class="text-muted">Status</span><br>
                    @if($org->status === 'active')
                        <span class="badge bg-success">Active</span>
                    @elseif($org->status === 'suspended')
                        <span class="badge bg-danger">Suspended</span>
                    @else
                        <span class="badge bg-secondary">{{ ucfirst($org->status) }}</span>
                    @endif
                </p>
                <p class="mb-2"><span class="text-muted">Phone</span><br>{{ $org->phone ?: '—' }}</p>
                <p class="mb-0"><span class="text-muted">Address</span><br>{{ $org->address ?: '—' }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-8 mb-3">
        <div class="card h-100">
            <div class="card-header"><h4 class="card-title mb-0">Recent transactions</h4></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr><th>When</th><th>Member</th><th>Type</th><th class="text-end">Amount</th></tr>
                        </thead>
                        <tbody>
                        @forelse($recentTransactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at }}</td>
                                <td>{{ $transaction->user ? $transaction->user->name : '—' }}</td>
                                <td class="text-capitalize">{{ $transaction->type }}</td>
                                <td class="text-end">₦{{ number_format($transaction->amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">No transactions yet.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

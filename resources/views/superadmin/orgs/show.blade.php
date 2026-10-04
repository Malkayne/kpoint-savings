@extends('superadmin.layouts.app')
@section('title', $org->name)
@section('content-header', $org->name)
@section('content-header-description', $org->slug.' · '.($org->email ?: 'No contact email'))
@section('header-action')
    <div class="d-flex flex-wrap gap-2">
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
<div class="row g-4 sa-gap">
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 mb-0"><div class="card-body"><p class="mb-1 text-muted">Members</p><h4 class="mb-0">{{ $org->users_count }}</h4></div></div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 mb-0"><div class="card-body"><p class="mb-1 text-muted">Reps</p><h4 class="mb-0">{{ $org->reps_count }}</h4></div></div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 mb-0"><div class="card-body"><p class="mb-1 text-muted">Admins</p><h4 class="mb-0">{{ $org->admins_count }}</h4></div></div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 mb-0"><div class="card-body"><p class="mb-1 text-muted">Transactions</p><h4 class="mb-0">{{ $org->transactions_count }}</h4></div></div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card h-100 mb-0">
            <div class="card-header"><h4 class="card-title mb-0">Details</h4></div>
            <div class="card-body">
                <p class="mb-3"><span class="text-muted">Status</span><br>
                    @if($org->status === 'active')
                        <span class="badge bg-success">Active</span>
                    @elseif($org->status === 'suspended')
                        <span class="badge bg-danger">Suspended</span>
                    @else
                        <span class="badge bg-secondary">{{ ucfirst($org->status) }}</span>
                    @endif
                </p>
                <p class="mb-3"><span class="text-muted">Phone</span><br>{{ $org->phone ?: '—' }}</p>
                <p class="mb-0"><span class="text-muted">Address</span><br>{{ $org->address ?: '—' }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card h-100 mb-0">
            <div class="card-header"><h4 class="card-title mb-0">Recent transactions</h4></div>
            <div class="card-body">
                <div class="custom-datatable-entries">
                    <table class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr><th>When</th><th>Member</th><th>Type</th><th>Amount</th></tr>
                        </thead>
                        <tbody>
                        @foreach($recentTransactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at }}</td>
                                <td>{{ $transaction->user ? $transaction->user->name : '—' }}</td>
                                <td class="text-capitalize">{{ $transaction->type }}</td>
                                <td>₦{{ number_format($transaction->amount, 2) }}</td>
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

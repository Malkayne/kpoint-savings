@extends('superadmin.layouts.app')
@section('title', $org->name)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">{{ $org->name }}</h1>
    <div>
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('superadmin.orgs.edit', $org) }}">Edit</a>
        @if($org->status === 'active')
            <form method="POST" action="{{ route('superadmin.enter-org', $org) }}" class="d-inline">@csrf<button class="btn btn-sm btn-primary" type="submit">Enter</button></form>
            <form method="POST" action="{{ route('superadmin.orgs.suspend', $org) }}" class="d-inline">@csrf<button class="btn btn-sm btn-outline-danger" type="submit">Suspend</button></form>
        @else
            <form method="POST" action="{{ route('superadmin.orgs.activate', $org) }}" class="d-inline">@csrf<button class="btn btn-sm btn-outline-success" type="submit">Activate</button></form>
        @endif
    </div>
</div>
<p class="text-muted">{{ $org->slug }} · {{ $org->status }} · {{ $org->email }}</p>
<div class="row mb-4">
    <div class="col">Members: <strong>{{ $org->users_count }}</strong></div>
    <div class="col">Reps: <strong>{{ $org->reps_count }}</strong></div>
    <div class="col">Admins: <strong>{{ $org->admins_count }}</strong></div>
    <div class="col">Transactions: <strong>{{ $org->transactions_count }}</strong></div>
</div>
<h2 class="h6">Recent transactions</h2>
<table class="table table-sm bg-white">
    <thead><tr><th>When</th><th>Member</th><th>Type</th><th>Amount</th></tr></thead>
    <tbody>
    @forelse($recentTransactions as $transaction)
        <tr>
            <td>{{ $transaction->created_at }}</td>
            <td>{{ $transaction->user ? $transaction->user->name : '—' }}</td>
            <td>{{ $transaction->type }}</td>
            <td>{{ $transaction->amount }}</td>
        </tr>
    @empty
        <tr><td colspan="4">No transactions.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection

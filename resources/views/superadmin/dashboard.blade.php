@extends('superadmin.layouts.app')
@section('title', 'Dashboard')
@section('content')
<h1 class="h4 mb-4">Platform dashboard</h1>
<div class="row">
    <div class="col-md-4 mb-3"><div class="card"><div class="card-body"><div class="text-muted">Organisations</div><strong>{{ $totalOrgs }}</strong> <span class="text-muted">({{ $activeOrgs }} active)</span></div></div></div>
    <div class="col-md-4 mb-3"><div class="card"><div class="card-body"><div class="text-muted">Members</div><strong>{{ $totalUsers }}</strong></div></div></div>
    <div class="col-md-4 mb-3"><div class="card"><div class="card-body"><div class="text-muted">Reps</div><strong>{{ $totalReps }}</strong></div></div></div>
    <div class="col-md-4 mb-3"><div class="card"><div class="card-body"><div class="text-muted">Transactions</div><strong>{{ $totalTransactions }}</strong></div></div></div>
    <div class="col-md-4 mb-3"><div class="card"><div class="card-body"><div class="text-muted">Member balances</div><strong>{{ number_format($totalWallet, 2) }}</strong></div></div></div>
</div>
<div class="d-flex justify-content-between align-items-center mb-2">
    <h2 class="h5 mb-0">Organisations</h2>
    <a class="btn btn-success btn-sm" href="{{ route('superadmin.orgs.create') }}">New organisation</a>
</div>
<table class="table table-sm bg-white">
    <thead><tr><th>Name</th><th>Status</th><th>Members</th><th>Reps</th><th>Transactions</th><th></th></tr></thead>
    <tbody>
    @foreach($orgs as $org)
        <tr>
            <td><a href="{{ route('superadmin.orgs.show', $org) }}">{{ $org->name }}</a></td>
            <td>{{ $org->status }}</td>
            <td>{{ $org->users_count }}</td>
            <td>{{ $org->reps_count }}</td>
            <td>{{ $org->transactions_count }}</td>
            <td>
                @if($org->status === 'active')
                    <form method="POST" action="{{ route('superadmin.enter-org', $org) }}" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-outline-primary" type="submit">Enter</button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection

@extends('layouts.rep.app')
@section('title', 'Users Wallet')
@section('content-header', 'Users Wallet')
@section('content-header-description', 'Manage your users\' wallet balances and activities')
@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users Wallet Table</h3>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="usersWalletDatatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Account Number</th>
                                    <th>Wallet Balance</th>
                                    <th>Status</th>
                                    <th>Active Plans</th>
                                    <th>Total Transactions</th>
                                    <th>Joined</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>
                                            <a href="{{ route('rep.userDetails', ['user' => $user->id]) }}" class="fw-bold">
                                                {{ $user->name }}
                                            </a>
                                        </td>
                                        <td>{{ $user->accNum }}</td>
                                        <td class="fw-bold text-success">₦{{ number_format($user->wallet_balance, 2) }}</td>
                                        <td>
                                            @if($user->status === 'active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->contributionPlans->where('status', 'active')->count() }}</td>
                                        <td>{{ $user->transactions->count() }}</td>
                                        <td>{{ $user->created_at ? $user->created_at->format('d M Y') : '' }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('rep.userDetails', ['user' => $user->id]) }}" class="btn btn-sm btn-info" title="View Details">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#creditModal{{ $user->id }}" title="Credit Wallet">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#debitModal{{ $user->id }}" title="Debit Wallet">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Account Number</th>
                                    <th>Wallet Balance</th>
                                    <th>Status</th>
                                    <th>Active Plans</th>
                                    <th>Total Transactions</th>
                                    <th>Joined</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Credit/Debit Wallet Modals -->
@foreach($users as $user)
<div class="modal fade" id="creditModal{{ $user->id }}" tabindex="-1" aria-labelledby="creditModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="creditModalLabel{{ $user->id }}">Credit Wallet: {{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('rep.updateUserWallet', ['transType' => 'credit', 'userID' => $user->id]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="amount{{ $user->id }}" class="form-label">Amount</label>
                        <input type="number" step="0.01" class="form-control" name="amount" id="amount{{ $user->id }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="narration{{ $user->id }}" class="form-label">Narration</label>
                        <textarea class="form-control" name="narration" id="narration{{ $user->id }}" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Credit Wallet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="debitModal{{ $user->id }}" tabindex="-1" aria-labelledby="debitModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="debitModalLabel{{ $user->id }}">Debit Wallet: {{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('rep.updateUserWallet', ['transType' => 'debit', 'userID' => $user->id]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="debitAmount{{ $user->id }}" class="form-label">Amount</label>
                        <input type="number" step="0.01" class="form-control" name="amount" id="debitAmount{{ $user->id }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="debitNarration{{ $user->id }}" class="form-label">Narration</label>
                        <textarea class="form-control" name="narration" id="debitNarration{{ $user->id }}" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Debit Wallet</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

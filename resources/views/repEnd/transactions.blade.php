@extends('layouts.rep.app')
@section('title', 'Transactions')
@section('content-header', 'Transactions')
@section('content-header-description', 'View all transactions for your users')
@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Transactions Table</h3>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="transactionsDatatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Wallet Type</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>
                                            <a href="{{ route('rep.userDetails', ['user' => $transaction->user->id]) }}" class="fw-bold">
                                                {{ $transaction->user->name }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($transaction->type === 'credit')
                                                <span class="badge bg-success">Credit</span>
                                            @else
                                                <span class="badge bg-danger">Debit</span>
                                            @endif
                                        </td>
                                        <td>₦{{ number_format($transaction->amount, 2) }}</td>
                                        <td>
                                            @if($transaction->wallet_type === 'savings')
                                                <span class="badge bg-primary">Savings</span>
                                            @elseif($transaction->wallet_type === 'business')
                                                <span class="badge bg-warning">Business</span>
                                            @else
                                                <span class="badge bg-info">User</span>
                                            @endif
                                        </td>
                                        <td>{{ $transaction->description ?? 'N/A' }}</td>
                                        <td>{{ $transaction->created_at ? $transaction->created_at->format('d M Y H:i') : '' }}</td>
                                        <td>
                                            <a href="{{ route('rep.userDetails', ['user' => $transaction->user->id]) }}" class="btn btn-sm btn-info" title="View User Details">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Wallet Type</th>
                                    <th>Description</th>
                                    <th>Date</th>
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
@endsection

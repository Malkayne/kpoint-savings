@extends('layouts.admin.app')
@section('title', 'Admin Wallet')
@section('content-header', 'Admin Wallet')
@section('content-header-description', 'View admin wallet balance and transaction history')
@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <!-- Admin Wallet Balance Card -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Admin Wallet Balance</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-success">
                                    <i class="fa fa-coins"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Current Balance</span>
                                    <span class="info-box-number">₦{{ number_format($adminWalletBalance, 2) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-info">
                                    <i class="fa fa-retweet"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Transactions</span>
                                    <span class="info-box-number">{{ $adminTransactions->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Transactions Table -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Admin Wallet Transactions</h3>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="adminTransactionsDatatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Rep</th>
                                    <th>Plan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach($adminTransactions as $transaction)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>{{ $transaction->created_at ? $transaction->created_at->format('d M Y H:i') : '' }}</td>
                                        <td>
                                            @if($transaction->type === 'credit')
                                                <span class="badge bg-success">Credit</span>
                                            @else
                                                <span class="badge bg-danger">Debit</span>
                                            @endif
                                        </td>
                                        <td class="fw-bold {{ $transaction->type === 'credit' ? 'text-success' : 'text-danger' }}">
                                            {{ $transaction->type === 'credit' ? '+' : '-' }}₦{{ number_format($transaction->amount, 2) }}
                                        </td>
                                        <td>{{ $transaction->description }}</td>
                                        <td>{{ $transaction->rep->name ?? 'N/A' }}</td>
                                        <td>
                                            @if($transaction->plan)
                                                <a href="{{ route('admin.planDetails', ['plan' => $transaction->plan->id]) }}" class="text-primary">
                                                    {{ $transaction->plan->title }}
                                                </a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Rep</th>
                                    <th>Plan</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($adminTransactions->isEmpty())
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center">
                <i class="fa fa-coins fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No transactions yet</h5>
                <p class="text-muted">Admin wallet transactions will appear here when plans are broken or other admin operations occur.</p>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

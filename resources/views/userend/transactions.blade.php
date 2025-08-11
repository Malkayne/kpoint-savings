@extends('layouts.users.app')
@section('title', 'Transactions')
@section('content-header', 'Transactions')
@section('content-header-description', 'View all your transaction history')
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

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Transaction History</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="transactionsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Wallet Type</th>
                                    <th>Description</th>
                                    <th>Plan</th>
                                    <th>Rep</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @forelse($transactions as $transaction)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>{{ $transaction->created_at ? $transaction->created_at->format('d M Y H:i') : '' }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($transaction->type === 'credit') bg-success
                                                @else bg-danger
                                                @endif">
                                                {{ ucfirst($transaction->type) }}
                                            </span>
                                        </td>
                                        <td>₦{{ number_format($transaction->amount, 2) }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ ucfirst($transaction->wallet_type) }}</span>
                                        </td>
                                        <td>{{ $transaction->description ?? 'N/A' }}</td>
                                        <td>
                                            @if($transaction->plan)
                                                <a href="{{ route('userend.planDetails', ['plan' => $transaction->plan->id]) }}" 
                                                   class="text-decoration-none">
                                                    {{ $transaction->plan->title }}
                                                </a>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($transaction->rep)
                                                {{ $transaction->rep->name }}
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="fas fa-receipt fa-2x mb-3"></i>
                                            <p class="mb-0">No transactions found</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#transactionsTable').DataTable({
        "order": [[ 1, "desc" ]],
        "pageLength": 25,
        "responsive": true
    });
});
</script>

@endsection 
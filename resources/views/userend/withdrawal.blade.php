@extends('layouts.users.app')
@section('title', 'Withdrawals')
@section('content-header', 'Withdrawals')
@section('content-header-description', 'Request a withdrawal and view status')
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
                    <h4 class="card-title">Request Withdrawal</h4>
                </div>
                <div class="card-body">
                  <form method="POST" action="{{ route('userend.withdrawal') }}" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
        <div class="col-md-4">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required>
            @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="bank_name" class="form-label">Bank Name</label>
            <input type="text" name="bank_name" class="form-control @error('bank_name') is-invalid @enderror" value="{{ old('bank_name') }}" required>
            @error('bank_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="account_number" class="form-label">Account Number</label>
            <input type="text" name="account_number" class="form-control @error('account_number') is-invalid @enderror" value="{{ old('account_number') }}" required>
            @error('account_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="account_name" class="form-label">Account Name</label>
            <input type="text" name="account_name" class="form-control @error('account_name') is-invalid @enderror" value="{{ old('account_name') }}" required>
            @error('account_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="signature" class="form-label">Signature (Image)</label>
            <input type="file" name="signature" class="form-control @error('signature') is-invalid @enderror" accept="image/*" required>
            @error('signature')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-primary">Submit Request</button>
        </div>
    </div>
</form>

                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="card-title">Withdrawal Requests</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="withdrawalsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Bank</th>
                                    <th>Account Number</th>
                                    <th>Account Name</th>
                                    <th>Signature</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @forelse($withdrawals as $withdrawal)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>{{ $withdrawal->created_at->format('d M Y H:i') }}</td>
                                        <td>₦{{ number_format($withdrawal->amount, 2) }}</td>
                                        <td>{{ $withdrawal->bank_name }}</td>
                                        <td>{{ $withdrawal->account_number }}</td>
                                         <td>{{ $withdrawal->account_name}}</td>
                                       <td>
    @if($withdrawal->signature_path)
        <a href="{{ asset($withdrawal->signature_path) }}" target="_blank">View</a>
    @else
        <span class="text-muted">N/A</span>
    @endif
</td>

                                        <td>
                                            <span class="badge 
                                                @if($withdrawal->status === 'pending') bg-warning
                                                @elseif($withdrawal->status === 'approved') bg-success
                                                @else bg-danger
                                                @endif">
                                                {{ ucfirst($withdrawal->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="fas fa-money-bill-wave fa-2x mb-3"></i>
                                            <p class="mb-0">No withdrawal requests found</p>
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
    $('#withdrawalsTable').DataTable({
        "order": [[ 1, "desc" ]],
        "pageLength": 25,
        "responsive": true
    });
});
</script>

@endsection

@extends('layouts.users.app')
@section('title', 'Manual Funding')
@section('content-header', 'Manual Funding')
@section('content-header-description', 'Submit funding request and view status')
@section('content')

<div class="container-fluid content-inner mt-n5 py-0">
    
    
       <div class="card">
          <div class="mb-4">
        <div class="border p-3 rounded bg-light">
            <h5 class="mb-2">Deposit Account Details:</h5>
            <p class="mb-1"><strong>Account Number:</strong> 0126422405</p>
            <p class="mb-1"><strong>Bank Name:</strong> Wema Bank</p>
            <p class="mb-1"><strong>Account Name:</strong> K-POINT DIGITAL SERVICES</p>
            <p class="text-danger mt-2 fw-bold">
                If you want to deposit ₦10,000 or more, please include an extra ₦50 to cover transaction charges.
            </p>
        </div>
    </div>
    </div>
    
    
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
                    <h4 class="card-title">Submit Manual Funding Request</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('userend.manual-fund-request') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" step="0.01" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="proof_of_payment" class="form-label">Proof of Payment (Image)</label>
                                <input type="file" name="proof_of_payment" class="form-control @error('proof_of_payment') is-invalid @enderror" accept="image/*" required>
                                @error('proof_of_payment')
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
                    <h4 class="card-title">Manual Funding Requests</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="fundingRequestsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Proof of Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @forelse($manual_fund_requests as $request)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>{{ $request->created_at->format('d M Y H:i') }}</td>
                                        <td>₦{{ number_format($request->amount, 2) }}</td>
                                        <td>
                                            @if($request->proof_of_payment)
                                                <a href="{{ asset($request->proof_of_payment) }}" target="_blank">View</a>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            <i class="fas fa-credit-card fa-2x mb-3"></i>
                                            <p class="mb-0">No funding requests found</p>
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
    $('#fundingRequestsTable').DataTable({
        "order": [[ 1, "desc" ]],
        "pageLength": 25,
        "responsive": true
    });
});
</script>

@endsection

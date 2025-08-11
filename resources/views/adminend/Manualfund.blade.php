@extends('layouts.admin.app')
@section('title', 'Manual Funding')
@section('content-header', 'Manual Funding')
@section('content-header-description', 'Submit funding request and view status')
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
                                    <th>User</th>
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
                                        <td><a href="/admin/userDetails/{{ $request->user->id }}"> {{ $request->user->name }} </a></td>
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

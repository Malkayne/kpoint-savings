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
                                    <th>Status</th>
                                    <th>Actions</th>
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
                                        <td>
                                            <span class="badge {{ $request->getStatusBadgeClass() }}">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($request->canUpdateStatus())
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#statusModal{{ $request->id }}">
                                                    Update Status
                                                </button>
                                            @else
                                                <span class="text-muted">Final Status</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
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

<!-- Status Update Modals -->
@foreach($manual_fund_requests as $request)
<div class="modal fade" id="statusModal{{ $request->id }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $request->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel{{ $request->id }}">Update Manual Funding Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.updateManualFundingStatus', $request) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status{{ $request->id }}" class="form-label">Status</label>
                        <select class="form-select" id="status{{ $request->id }}" name="status" required>
                            <option value="pending" {{ $request->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="ongoing" {{ $request->status === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="done" {{ $request->status === 'done' ? 'selected' : '' }}>Done</option>
                            <option value="reversed" {{ $request->status === 'reversed' ? 'selected' : '' }}>Reversed</option>
                            <option value="failed" {{ $request->status === 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                    <div class="alert alert-info">
                        <strong>Note:</strong> Only transactions with status "pending" or "ongoing" can be updated.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

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

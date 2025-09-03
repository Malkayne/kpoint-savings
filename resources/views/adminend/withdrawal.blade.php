@extends('layouts.admin.app')
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
                                     <th>User</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Bank</th>
                                    <th>Account Number</th>
                                    <th>Account Name</th>
                                    <th>Signature</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @forelse($withdrawals as $withdrawal)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td><a href="/admin/userDetails/{{ $withdrawal->user->id }}"> {{ $withdrawal->user->name }} </a></td>
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
                                            <span class="badge {{ $withdrawal->getStatusBadgeClass() }}">
                                                {{ ucfirst($withdrawal->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($withdrawal->canUpdateStatus())
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#statusModal{{ $withdrawal->id }}">
                                                    Update Status
                                                </button>
                                            @else
                                                <span class="text-muted">Final Status</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
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

<!-- Status Update Modals -->
@foreach($withdrawals as $withdrawal)
<div class="modal fade" id="statusModal{{ $withdrawal->id }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $withdrawal->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel{{ $withdrawal->id }}">Update Withdrawal Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.updateWithdrawalStatus', $withdrawal) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status{{ $withdrawal->id }}" class="form-label">Status</label>
                        <select class="form-select" id="status{{ $withdrawal->id }}" name="status" required>
                            <option value="pending" {{ $withdrawal->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="ongoing" {{ $withdrawal->status === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="done" {{ $withdrawal->status === 'done' ? 'selected' : '' }}>Done</option>
                            <option value="reversed" {{ $withdrawal->status === 'reversed' ? 'selected' : '' }}>Reversed</option>
                            <option value="failed" {{ $withdrawal->status === 'failed' ? 'selected' : '' }}>Failed</option>
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
    $('#withdrawalsTable').DataTable({
        "order": [[ 1, "desc" ]],
        "pageLength": 25,
        "responsive": true
    });
});
</script>

@endsection

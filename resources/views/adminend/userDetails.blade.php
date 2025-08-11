@extends('layouts.admin.app')
@section('title', 'User Details')
@section('content-header', 'User Details')
@section('content-header-description', 'View detailed information about ' . $user->name)
@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <!-- User Profile Card -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User Profile</h4>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <img src="{{ $user->image ? asset('public/Images/Users/' . $user->image) : asset('public/Images/Users/default.jpeg') }}" 
                             class="rounded-circle" width="120" height="120" alt="User Image">
                    </div>
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="text-muted">{{ $user->username }}</p>
                    <div class="row text-start">
                        <div class="col-6">
                            <p><strong>Email:</strong></p>
                            <p><strong>Phone:</strong></p>
                            <p><strong>Account Number:</strong></p>
                            <p><strong>Status:</strong></p>
                            <p><strong>Wallet Balance:</strong></p>
                            <p><strong>Rep:</strong></p>
                            <p><strong>Joined:</strong></p>
                        </div>
                        <div class="col-6">
                            <p>{{ $user->email }}</p>
                            <p>{{ $user->phone }}</p>
                            <p>{{ $user->accNum }}</p>
                            <p>
                                @if($user->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </p>
                            <p class="text-success fw-bold">₦{{ number_format($user->wallet_balance, 2) }}</p>
                            <p>{{ $user->rep->name ?? 'N/A' }}</p>
                            <p>{{ $user->created_at ? $user->created_at->format('d M Y') : '' }}</p>
                            
                               <p> User Signature</p>
                               
                                  <p><img src="/public/Images/Signatures/{{ $user->signature??'' }}" width="120" hieght="120"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="col-lg-8">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fa fa-list text-primary" style="font-size: 2rem;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0">{{ $contributionPlans->count() }}</h4>
                                    <p class="text-muted mb-0">Total Plans</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fa fa-exchange text-success" style="font-size: 2rem;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0">{{ $transactions->count() }}</h4>
                                    <p class="text-muted mb-0">Total Transactions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fa fa-check-circle text-info" style="font-size: 2rem;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0">{{ $contributionPlans->where('status', 'completed')->count() }}</h4>
                                    <p class="text-muted mb-0">Completed Plans</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contribution Plans Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Contribution Plans ({{ $contributionPlans->count() }})</h4>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                    <th>Start Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach($contributionPlans as $plan)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>{{ $plan->title }}</td>
                                        <td>₦{{ number_format($plan->amount, 2) }}</td>
                                        <td>{{ $plan->duration }} days</td>
                                        <td>
                                            @if($plan->status === 'active')
                                                <span class="badge bg-success">Active</span>
                                            @elseif($plan->status === 'completed')
                                                <span class="badge bg-info">Completed</span>
                                            @else
                                                <span class="badge bg-warning">Broken</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $progress = $plan->contributions->count();
                                                $percentage = $plan->duration > 0 ? ($progress / $plan->duration) * 100 : 0;
                                            @endphp
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%" 
                                                     aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                                    {{ $progress }}/{{ $plan->duration }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $plan->start_date ? date('d M Y', strtotime($plan->start_date)) : '' }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning" title="Break Plan" 
                                                    onclick="breakPlan({{ $plan->id }}, '{{ $plan->title }}')">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Transactions ({{ $transactions->count() }})</h4>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Wallet Type</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function breakPlan(planId, planTitle) {
    if (confirm('Are you sure you want to break the plan: ' + planTitle + '?')) {
        window.location.href = '/admin/breakPlan/' + planId;
    }
}
</script>
@endsection 
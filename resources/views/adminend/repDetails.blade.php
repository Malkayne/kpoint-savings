@extends('layouts.admin.app')
@section('title', 'Rep Details')
@section('content-header', 'Rep Details')
@section('content-header-description', 'View detailed information about ' . $rep->name)
@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <!-- Rep Profile Card -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Rep Profile</h4>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <img src="{{ $rep->image ? asset('public/Images/Reps/' . $rep->image) : asset('public/Images/Reps/default.jpeg') }}" 
                             class="rounded-circle" width="120" height="120" alt="Rep Image">
                    </div>
                    <h5 class="card-title">{{ $rep->name }}</h5>
                    <p class="text-muted">{{ $rep->username }}</p>
                    <div class="row text-start">
                        <div class="col-6">
                            <p><strong>Email:</strong></p>
                            <p><strong>Phone:</strong></p>
                            <p><strong>Status:</strong></p>
                            <p><strong>Wallet Balance:</strong></p>
                            <p><strong>Joined:</strong></p>
                        </div>
                        <div class="col-6">
                            <p>{{ $rep->email }}</p>
                            <p>{{ $rep->phone }}</p>
                            <p>
                                @if($rep->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </p>
                            <p class="text-success fw-bold">₦{{ number_format($rep->wallet_balance, 2) }}</p>
                            <p>{{ $rep->created_at ? $rep->created_at->format('d M Y') : '' }}</p>
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
                                    <i class="fa fa-users text-primary" style="font-size: 2rem;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0">{{ $users->count() }}</h4>
                                    <p class="text-muted mb-0">Total Users</p>
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
                                    <i class="fa fa-list text-success" style="font-size: 2rem;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0">{{ $contributionPlans->count() }}</h4>
                                    <p class="text-muted mb-0">Active Plans</p>
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
                                    <i class="fa fa-exchange text-info" style="font-size: 2rem;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0">{{ $transactions->count() }}</h4>
                                    <p class="text-muted mb-0">Total Transactions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Users ({{ $users->count() }})</h4>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Account Number</th>
                                    <th>Phone</th>
                                    <th>Wallet Balance</th>
                                    <th>Status</th>
                                    <th>Joined</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->accNum }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>₦{{ number_format($user->wallet_balance, 2) }}</td>
                                        <td>
                                            @if($user->status === 'active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at ? $user->created_at->format('d M Y') : '' }}</td>
                                        <td>
                                            <a href="{{ route('admin.editUser', ['user' => $user->id]) }}" class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.userTransaction') }}?uid={{ $user->id }}" class="btn btn-sm btn-info" title="View Transactions">
                                                <i class="fa fa-list"></i>
                                            </a>
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
                                    <th>User</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach($contributionPlans as $plan)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>{{ $plan->user->name }}</td>
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
                                        <td>{{ $plan->start_date ? date('d M Y', strtotime($plan->start_date)) : '' }}</td>
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
                                    <th>User</th>
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
                                        <td>{{ $transaction->user->name }}</td>
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
@endsection 
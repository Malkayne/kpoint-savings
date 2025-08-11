@extends('layouts.admin.app')
@section('title', 'Profile')
@section('content-header', 'Profile')
@section('content-header-description', 'Manage your admin profile and settings')
@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <!-- Profile Card -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Admin Profile</h4>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <img src="{{ auth()->user()->image ? asset('public/Images/Admins/' . auth()->user()->image) : asset('public/Images/Admins/default.jpeg') }}" 
                             class="rounded-circle" width="120" height="120" alt="Admin Image">
                    </div>
                    <h5 class="card-title">{{ auth()->user()->name }}</h5>
                    <p class="text-muted">{{ auth()->user()->username }}</p>
                    <div class="row text-start">
                        <div class="col-6">
                            <p><strong>Email:</strong></p>
                            <p><strong>Username:</strong></p>
                            <p><strong>Joined:</strong></p>
                        </div>
                        <div class="col-6">
                            <p>{{ auth()->user()->email }}</p>
                            <p>{{ auth()->user()->username }}</p>
                            <p>{{ auth()->user()->created_at ? auth()->user()->created_at->format('d M Y') : '' }}</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="fa fa-edit"></i> Edit Profile
                        </button>
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
                                    <h4 class="mb-0">{{ $totalUsers }}</h4>
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
                                    <i class="fa fa-user-plus text-success" style="font-size: 2rem;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0">{{ $totalReps }}</h4>
                                    <p class="text-muted mb-0">Total Reps</p>
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
                                    <i class="fa fa-list text-info" style="font-size: 2rem;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0">{{ $totalPlans }}</h4>
                                    <p class="text-muted mb-0">Active Plans</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent System Activity</h4>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Activity</th>
                                    <th>User/Rep</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach($recentTransactions as $transaction)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>
                                            @if($transaction->type === 'credit')
                                                <span class="badge bg-success">Credit</span>
                                            @else
                                                <span class="badge bg-danger">Debit</span>
                                            @endif
                                        </td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td>₦{{ number_format($transaction->amount, 2) }}</td>
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

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.updateProfile', ['adminID' => auth()->user()->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ auth()->user()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="{{ auth()->user()->username }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ auth()->user()->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

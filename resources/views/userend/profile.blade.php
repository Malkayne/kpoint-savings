@extends('layouts.users.app')
@section('title', 'Profile')
@section('content-header', 'Profile')
@section('content-header-description', 'View your profile information')
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

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Profile Picture</h4>
                        </div>
                        <div class="card-body text-center">
                            @if($user->profile_pix)
                                <img src="{{  asset('public/Images/ProfilePics/' .$user->profile_pix) }}" 
                                     alt="Profile Picture" 
                                     class="rounded-circle mb-3" 
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                     style="width: 150px; height: 150px;">
                                    <i class="fas fa-user fa-3x text-muted"></i>
                                </div>
                            @endif
                            <h5 class="mb-1">{{ $user->name }}</h5>
                            <p class="text-muted mb-3">{{ $user->username }}</p>
                            <a href="{{ route('userend.editProfile') }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Personal Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Full Name</label>
                                    <p class="mb-0">{{ $user->name }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Username</label>
                                    <p class="mb-0">{{ $user->username }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <p class="mb-0">{{ $user->email ?? 'N/A' }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Phone Number</label>
                                    <p class="mb-0">{{ $user->phone }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Account Number</label>
                                    <p class="mb-0">{{ $user->accNum }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Wallet Balance</label>
                                    <p class="mb-0">₦{{ number_format($user->wallet_balance, 2) }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Profession</label>
                                    <p class="mb-0">{{ $user->profession ?? 'N/A' }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Education</label>
                                    <p class="mb-0">{{ $user->education ?? 'N/A' }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Date of Birth</label>
                                    <p class="mb-0">{{ $user->dob ? date('d M Y', strtotime($user->dob)) : 'N/A' }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Status</label>
                                    <p class="mb-0">
                                        <span class="badge 
                                            @if($user->status === 'active') bg-success
                                            @else bg-danger
                                            @endif">
                                            {{ ucfirst($user->status) }}
                                        </span>
                                    </p>
                                </div>
                                
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Address</label>
                                    <p class="mb-0">{{ $user->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4 class="card-title">Next of Kin Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">NOK Name</label>
                                    <p class="mb-0">{{ $user->nok_name }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">NOK Phone</label>
                                    <p class="mb-0">{{ $user->nok_phone }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">NOK Relationship</label>
                                    <p class="mb-0">{{ $user->nok_relationship }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Representative</label>
                                    <p class="mb-0">{{ $user->rep ? $user->rep->name . ' (' . $user->rep->username . ')' : 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4 class="card-title">Account Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Member Since</label>
                                    <p class="mb-0">{{ $user->created_at ? $user->created_at->format('d M Y') : 'N/A' }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Last Updated</label>
                                    <p class="mb-0">{{ $user->updated_at ? $user->updated_at->format('d M Y H:i') : 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 
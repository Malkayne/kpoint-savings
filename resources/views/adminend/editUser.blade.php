@extends('layouts.admin.app')
@section('title', 'Edit User')
@section('content-header', 'Edit User')
@section('content-header-description', 'Update user profile and details')
@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit User</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.updateUserProfile', ['userID' => $userDetails->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $userDetails->name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" value="{{ $userDetails->username }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $userDetails->email }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="accNum" class="form-label">Account Number</label>
                                <input type="text" class="form-control" name="accNum" id="accNum" value="{{ $userDetails->accNum }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="wallet_balance" class="form-label">Wallet Balance</label>
                                <input type="text" class="form-control" name="wallet_balance" id="wallet_balance" value="{{ number_format($userDetails->wallet_balance, 2) }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{ $userDetails->phone }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="profession" class="form-label">Profession</label>
                                <input type="text" class="form-control" name="profession" id="profession" value="{{ $userDetails->profession }}">
                            </div>
                            <div class="col-md-6">
                                <label for="education" class="form-label">Education</label>
                                <input type="text" class="form-control" name="education" id="education" value="{{ $userDetails->education }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" name="address" id="address" rows="2" required>{{ $userDetails->address }}</textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" name="dob" id="dob" value="{{ $userDetails->dob }}">
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="active" {{ $userDetails->status === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $userDetails->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="nok_name" class="form-label">Next of Kin Name</label>
                                <input type="text" class="form-control" name="nok_name" id="nok_name" value="{{ $userDetails->nok_name }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="nok_phone" class="form-label">Next of Kin Phone</label>
                                <input type="text" class="form-control" name="nok_phone" id="nok_phone" value="{{ $userDetails->nok_phone }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="nok_relationship" class="form-label">NOK Relationship</label>
                                <input type="text" class="form-control" name="nok_relationship" id="nok_relationship" value="{{ $userDetails->nok_relationship }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="rep_id" class="form-label">Rep</label>
                            <select class="form-control" name="rep_id" id="rep_id" required>
                                <option value="" disabled selected>Select Rep</option>
                                @foreach($reps as $rep)
                                    <option value="{{ $rep->id }}" {{ (isset($userDetails->rep_id) && $userDetails->rep_id == $rep->id) ? 'selected' : '' }}>{{ $rep->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Profile Image</label><br>
                            <img src="{{ $userDetails->image ? asset('public/Images/Users/' . $userDetails->image) : asset('public/Images/Users/default.jpeg') }}" width="100" class="mb-2">
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <div class="mb-3 text-end">
                            <button type="submit" class="btn btn-success">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

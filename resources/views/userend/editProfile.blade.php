@extends('layouts.users.app')
@section('title', 'Edit Profile')
@section('content-header', 'Edit Profile')
@section('content-header-description', 'Update your profile information')
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
                    <h4 class="card-title">Edit Profile Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('userend.updateProfile') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Username *</label>
                                <input type="text" 
                                       class="form-control @error('username') is-invalid @enderror" 
                                       id="username" 
                                       name="username" 
                                       value="{{ old('username', $user->username) }}" 
                                       required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone Number *</label>
                                <input type="text" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone', $user->phone) }}" 
                                       required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="profession" class="form-label">Profession</label>
                                <input type="text" 
                                       class="form-control @error('profession') is-invalid @enderror" 
                                       id="profession" 
                                       name="profession" 
                                       value="{{ old('profession', $user->profession) }}">
                                @error('profession')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="education" class="form-label">Education</label>
                                <input type="text" 
                                       class="form-control @error('education') is-invalid @enderror" 
                                       id="education" 
                                       name="education" 
                                       value="{{ old('education', $user->education) }}">
                                @error('education')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" 
                                       class="form-control @error('dob') is-invalid @enderror" 
                                       id="dob" 
                                       name="dob" 
                                       value="{{ old('dob', $user->dob ? $user->dob->format('Y-m-d') : '') }}">
                                @error('dob')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="rep_name" class="form-label">Representative</label>
                                <input type="text"
                                       class="form-control"
                                       id="rep_name"
                                       name="rep_name"
                                       value="{{ $user->rep ? $user->rep->name . ' (' . $user->rep->username . ')' : 'N/A' }}"
                                       disabled>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="address" class="form-label">Address *</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" 
                                          name="address" 
                                          rows="3" 
                                          required>{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <hr>
                        <h5 class="mb-3">Next of Kin Information</h5>
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="nok_name" class="form-label">NOK Name *</label>
                                <input type="text" 
                                       class="form-control @error('nok_name') is-invalid @enderror" 
                                       id="nok_name" 
                                       name="nok_name" 
                                       value="{{ old('nok_name', $user->nok_name) }}" 
                                       required>
                                @error('nok_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="nok_phone" class="form-label">NOK Phone *</label>
                                <input type="text" 
                                       class="form-control @error('nok_phone') is-invalid @enderror" 
                                       id="nok_phone" 
                                       name="nok_phone" 
                                       value="{{ old('nok_phone', $user->nok_phone) }}" 
                                       required>
                                @error('nok_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="nok_relationship" class="form-label">NOK Relationship *</label>
                                <input type="text"
                                       class="form-control @error('nok_relationship') is-invalid @enderror"
                                       id="nok_relationship"
                                       name="nok_relationship"
                                       value="{{ old('nok_relationship', $user->nok_relationship) }}"
                                       required>
                                @error('nok_relationship')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('userend.profile') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Profile
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 
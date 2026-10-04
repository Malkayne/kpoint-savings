@extends('superadmin.layouts.app')
@section('title', 'New organisation')
@section('content-header', 'New organisation')
@section('content-header-description', 'The first admin can sign in at the organisation admin login')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <form method="POST" action="{{ route('superadmin.orgs.store') }}">
            @csrf
            <div class="card mb-3">
                <div class="card-header"><h4 class="card-title mb-0">Organisation</h4></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input id="slug" name="slug" value="{{ old('slug') }}" class="form-control @error('slug') is-invalid @enderror" placeholder="kpoint-savings" required>
                        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-0">
                        <label for="email" class="form-label">Contact email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Where withdrawal mail is sent">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h4 class="card-title mb-0">First admin</h4></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="admin_name" class="form-label">Name</label>
                            <input id="admin_name" name="admin_name" value="{{ old('admin_name') }}" class="form-control @error('admin_name') is-invalid @enderror" required>
                            @error('admin_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="admin_username" class="form-label">Username</label>
                            <input id="admin_username" name="admin_username" value="{{ old('admin_username') }}" class="form-control @error('admin_username') is-invalid @enderror" required>
                            @error('admin_username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="admin_email" class="form-label">Email</label>
                        <input id="admin_email" type="email" name="admin_email" value="{{ old('admin_email') }}" class="form-control @error('admin_email') is-invalid @enderror" required>
                        @error('admin_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="admin_password" class="form-label">Password</label>
                        <input id="admin_password" type="password" name="admin_password" class="form-control @error('admin_password') is-invalid @enderror" required>
                        @error('admin_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Create organisation</button>
                    <a class="btn btn-link" href="{{ route('superadmin.orgs') }}">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

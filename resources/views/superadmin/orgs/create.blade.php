@extends('superadmin.layouts.app')
@section('title', 'New organisation')
@section('content-header', 'New organisation')
@section('content-header-description', 'Creates the organisation and the first admin who signs in at the organisation login')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <form method="POST" action="{{ route('superadmin.orgs.store') }}" autocomplete="off">
            @csrf
            <div class="card sa-gap">
                <div class="card-header"><h4 class="card-title mb-0">Organisation</h4></div>
                <div class="card-body">
                    <div class="mb-4">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="KPoint Savings" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="slug" class="form-label">
                            Slug
                            <i class="fas fa-circle-info text-muted ms-1" data-bs-toggle="tooltip" title="A short unique id, lowercase with hyphens. Members never see it. It is kept for a later address such as kpoint-savings."></i>
                        </label>
                        <input id="slug" name="slug" value="{{ old('slug') }}" class="form-control @error('slug') is-invalid @enderror" placeholder="kpoint-savings" required>
                        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-0">
                        <label for="email" class="form-label">
                            Contact email
                            <i class="fas fa-circle-info text-muted ms-1" data-bs-toggle="tooltip" title="Withdrawal and manual-funding mail is sent here. Leave it blank to use the shared product mailbox."></i>
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="accounts@example.com">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-header"><h4 class="card-title mb-0">First admin</h4></div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="admin_name" class="form-label">Name</label>
                            <input id="admin_name" name="admin_name" value="{{ old('admin_name') }}" class="form-control @error('admin_name') is-invalid @enderror" placeholder="Ada Okonkwo" required>
                            @error('admin_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="admin_username" class="form-label">
                                Username
                                <i class="fas fa-circle-info text-muted ms-1" data-bs-toggle="tooltip" title="What this admin types at the organisation admin login. It is not the platform login."></i>
                            </label>
                            <input id="admin_username" name="admin_username" value="{{ old('admin_username') }}" class="form-control @error('admin_username') is-invalid @enderror" placeholder="ada.okonkwo" required>
                            @error('admin_username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label for="admin_email" class="form-label">Email</label>
                            <input id="admin_email" type="email" name="admin_email" value="{{ old('admin_email') }}" class="form-control @error('admin_email') is-invalid @enderror" placeholder="ada@example.com" required>
                            @error('admin_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label for="admin_password" class="form-label">
                                Password
                                <i class="fas fa-circle-info text-muted ms-1" data-bs-toggle="tooltip" title="At least 8 characters. Share it with the admin privately. They sign in at the organisation admin login."></i>
                            </label>
                            <input id="admin_password" type="password" name="admin_password" autocomplete="new-password" class="form-control @error('admin_password') is-invalid @enderror" placeholder="At least 8 characters" required>
                            @error('admin_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary" type="submit">Create organisation</button>
                        <a class="btn btn-link" href="{{ route('superadmin.orgs') }}">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

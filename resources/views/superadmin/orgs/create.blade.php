@extends('superadmin.layouts.app')
@section('title', 'New organisation')
@section('content')
<h1 class="h4 mb-3">New organisation</h1>
<form method="POST" action="{{ route('superadmin.orgs.store') }}" class="bg-white p-4" style="max-width:640px;">
    @csrf
    <h2 class="h6">Organisation</h2>
    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
        <label for="slug">Slug</label>
        <input id="slug" name="slug" value="{{ old('slug') }}" class="form-control @error('slug') is-invalid @enderror" required>
        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
        <label for="email">Contact email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <h2 class="h6 mt-3">First admin</h2>
    <div class="form-group">
        <label for="admin_name">Name</label>
        <input id="admin_name" name="admin_name" value="{{ old('admin_name') }}" class="form-control @error('admin_name') is-invalid @enderror" required>
        @error('admin_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
        <label for="admin_email">Email</label>
        <input id="admin_email" type="email" name="admin_email" value="{{ old('admin_email') }}" class="form-control @error('admin_email') is-invalid @enderror" required>
        @error('admin_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
        <label for="admin_username">Username</label>
        <input id="admin_username" name="admin_username" value="{{ old('admin_username') }}" class="form-control @error('admin_username') is-invalid @enderror" required>
        @error('admin_username')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
        <label for="admin_password">Password</label>
        <input id="admin_password" type="password" name="admin_password" class="form-control @error('admin_password') is-invalid @enderror" required>
        @error('admin_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button class="btn btn-success" type="submit">Create organisation</button>
    <a class="btn btn-link" href="{{ route('superadmin.orgs') }}">Cancel</a>
</form>
@endsection

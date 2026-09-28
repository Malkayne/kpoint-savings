@extends('superadmin.layouts.app')
@section('title', 'Edit '.$org->name)
@section('content')
<h1 class="h4 mb-3">Edit {{ $org->name }}</h1>
<form method="POST" action="{{ route('superadmin.orgs.update', $org) }}" class="bg-white p-4" style="max-width:640px;">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" name="name" value="{{ old('name', $org->name) }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="slug">Slug</label>
        <input id="slug" name="slug" value="{{ old('slug', $org->slug) }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', $org->email) }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input id="phone" name="phone" value="{{ old('phone', $org->phone) }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input id="address" name="address" value="{{ old('address', $org->address) }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select id="status" name="status" class="form-control">
            @foreach(['active', 'suspended', 'inactive'] as $status)
                <option value="{{ $status }}" {{ old('status', $org->status) === $status ? 'selected' : '' }}>{{ $status }}</option>
            @endforeach
        </select>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <button class="btn btn-success" type="submit">Save</button>
    <a class="btn btn-link" href="{{ route('superadmin.orgs.show', $org) }}">Cancel</a>
</form>
@endsection

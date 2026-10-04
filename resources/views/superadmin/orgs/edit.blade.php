@extends('superadmin.layouts.app')
@section('title', 'Edit '.$org->name)
@section('content-header', 'Edit '.$org->name)
@section('content-header-description', 'Update the organisation profile and status')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('superadmin.orgs.update', $org) }}">
                    @csrf
                    @method('PUT')
                    @if($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" name="name" value="{{ old('name', $org->name) }}" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input id="slug" name="slug" value="{{ old('slug', $org->slug) }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email', $org->email) }}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input id="phone" name="phone" value="{{ old('phone', $org->phone) }}" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input id="address" name="address" value="{{ old('address', $org->address) }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select">
                            @foreach(['active', 'suspended', 'inactive'] as $status)
                                <option value="{{ $status }}" {{ old('status', $org->status) === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>
                    <a class="btn btn-link" href="{{ route('superadmin.orgs.show', $org) }}">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

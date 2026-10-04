@extends('superadmin.layouts.app')
@section('title', 'Edit '.$org->name)
@section('content-header', 'Edit '.$org->name)
@section('content-header-description', 'Update the organisation profile and status')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card mb-0">
            <div class="card-body">
                <form method="POST" action="{{ route('superadmin.orgs.update', $org) }}">
                    @csrf
                    @method('PUT')
                    @if($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" name="name" value="{{ old('name', $org->name) }}" class="form-control" placeholder="KPoint Savings" required>
                        </div>
                        <div class="col-md-6">
                            <label for="slug" class="form-label">
                                Slug
                                <i class="fas fa-circle-info text-muted ms-1" data-bs-toggle="tooltip" title="A short unique id, lowercase with hyphens. Members never see it."></i>
                            </label>
                            <input id="slug" name="slug" value="{{ old('slug', $org->slug) }}" class="form-control" placeholder="kpoint-savings" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">
                                Email
                                <i class="fas fa-circle-info text-muted ms-1" data-bs-toggle="tooltip" title="Withdrawal and manual-funding mail is sent here. Leave it blank to use the shared product mailbox."></i>
                            </label>
                            <input id="email" type="email" name="email" value="{{ old('email', $org->email) }}" class="form-control" placeholder="accounts@example.com">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input id="phone" name="phone" value="{{ old('phone', $org->phone) }}" class="form-control" placeholder="08012345678">
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input id="address" name="address" value="{{ old('address', $org->address) }}" class="form-control" placeholder="12 Marina Road, Lagos">
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">
                                Status
                                <i class="fas fa-circle-info text-muted ms-1" data-bs-toggle="tooltip" title="Suspended and inactive organisations cannot sign in, and their members cannot register."></i>
                            </label>
                            <select id="status" name="status" class="form-select">
                                @foreach(['active', 'suspended', 'inactive'] as $status)
                                    <option value="{{ $status }}" {{ old('status', $org->status) === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a class="btn btn-link" href="{{ route('superadmin.orgs.show', $org) }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

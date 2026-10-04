@extends('superadmin.layouts.app')
@section('title', 'Organisations')
@section('content-header', 'Organisations')
@section('content-header-description', 'Create, open, or suspend an organisation')
@section('header-action')
    <a href="{{ route('superadmin.orgs.create') }}" class="btn btn-primary">New organisation</a>
@endsection
@section('content')
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Members</th>
                        <th>Reps</th>
                        <th>Admins</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($orgs as $org)
                    <tr>
                        <td><a href="{{ route('superadmin.orgs.show', $org) }}" class="fw-bold">{{ $org->name }}</a></td>
                        <td>{{ $org->slug }}</td>
                        <td>
                            @if($org->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif($org->status === 'suspended')
                                <span class="badge bg-danger">Suspended</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($org->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $org->users_count }}</td>
                        <td>{{ $org->reps_count }}</td>
                        <td>{{ $org->admins_count }}</td>
                        <td class="text-end text-nowrap">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('superadmin.orgs.show', $org) }}">View</a>
                            @if($org->status === 'active')
                                <form method="POST" action="{{ route('superadmin.enter-org', $org) }}" class="d-inline">@csrf<button class="btn btn-sm btn-primary" type="submit">Enter</button></form>
                                <form method="POST" action="{{ route('superadmin.orgs.suspend', $org) }}" class="d-inline">@csrf<button class="btn btn-sm btn-outline-danger" type="submit">Suspend</button></form>
                            @else
                                <form method="POST" action="{{ route('superadmin.orgs.activate', $org) }}" class="d-inline">@csrf<button class="btn btn-sm btn-outline-success" type="submit">Activate</button></form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No organisations yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($orgs->hasPages())
        <div class="card-footer">{{ $orgs->links() }}</div>
    @endif
</div>
@endsection

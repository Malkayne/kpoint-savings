@extends('superadmin.layouts.app')
@section('title', 'Organisations')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Organisations</h1>
    <a class="btn btn-success btn-sm" href="{{ route('superadmin.orgs.create') }}">New organisation</a>
</div>
<table class="table table-sm bg-white">
    <thead><tr><th>Name</th><th>Slug</th><th>Status</th><th>Members</th><th>Reps</th><th>Admins</th><th></th></tr></thead>
    <tbody>
    @foreach($orgs as $org)
        <tr>
            <td><a href="{{ route('superadmin.orgs.show', $org) }}">{{ $org->name }}</a></td>
            <td>{{ $org->slug }}</td>
            <td>{{ $org->status }}</td>
            <td>{{ $org->users_count }}</td>
            <td>{{ $org->reps_count }}</td>
            <td>{{ $org->admins_count }}</td>
            <td class="text-nowrap">
                @if($org->status === 'active')
                    <form method="POST" action="{{ route('superadmin.enter-org', $org) }}" class="d-inline">@csrf<button class="btn btn-sm btn-outline-primary" type="submit">Enter</button></form>
                    <form method="POST" action="{{ route('superadmin.orgs.suspend', $org) }}" class="d-inline">@csrf<button class="btn btn-sm btn-outline-danger" type="submit">Suspend</button></form>
                @else
                    <form method="POST" action="{{ route('superadmin.orgs.activate', $org) }}" class="d-inline">@csrf<button class="btn btn-sm btn-outline-success" type="submit">Activate</button></form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $orgs->links() }}
@endsection

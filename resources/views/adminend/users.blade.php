@extends('layouts.admin.app')
@section('title', 'Users')
@section('content-header', 'Users')
@section('content-header-description', 'Manage all registered users and their details')
@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users Table</h3>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="pendingDatatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Account Number</th>
                                    <th>Wallet Balance</th>
                                    <th>Phone</th>
                                    <th>Profession</th>
                                    <th>Education</th>
                                    <th>Address</th>
                                    <th>Date of Birth</th>
                                    <th>Status</th>
                                    <th>NOK Name</th>
                                    <th>NOK Phone</th>
                                    <th>NOK Relationship</th>
                                    <th>Rep</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td><a href="{{ route('admin.userDetails', ['user' => $user->id]) }}" class="fw-bold">{{ $user->name }}</a></td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><a href="{{ route('admin.userTransaction') }}?uid={{ $user->id }}">{{ $user->accNum }}</a></td>
                                        <td>{{ number_format($user->wallet_balance, 2) }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->profession ?? 'N/A' }}</td>
                                        <td>{{ $user->education ?? 'N/A' }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->dob ? date('d M Y', strtotime($user->dob)) : 'N/A' }}</td>
                                        <td>
                                            @if($user->status === 'active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->nok_name }}</td>
                                        <td>{{ $user->nok_phone }}</td>
                                        <td>{{ $user->nok_relationship }}</td>
                                        <td>{{ $user->rep->name ?? 'N/A' }}</td>
                                        <td>{{ $user->created_at ? $user->created_at->format('d M Y') : '' }}</td>
                                        <td>
                                            <a href="{{ route('admin.editUser', ['user' => $user->id]) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('admin.changeUserPassword', ['user' => $user->id]) }}" class="btn btn-sm btn-warning" title="Change Password"><i class="fa fa-lock"></i></a>
                                            <a href="/admin/deleteUser/{{ $user->id }}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa fa-trash"></i></a>
                                            <a href="/admin/lockUser?user_id={{ $user->id }}" class="btn btn-sm {{ $user->status === 'active' ? 'btn-danger' : 'btn-success' }}" title="{{ $user->status === 'active' ? 'Lock' : 'Unlock' }}">
                                                <i class="fa {{ $user->status === 'active' ? 'fa-ban' : 'fa-unlock' }}"></i>
                                            </a>
                                            <a href="{{ route('admin.userTransaction') }}?uid={{ $user->id }}" class="btn btn-sm btn-info" title="View Transactions"><i class="fa fa-list"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Account Number</th>
                                    <th>Wallet Balance</th>
                                    <th>Phone</th>
                                    <th>Profession</th>
                                    <th>Education</th>
                                    <th>Address</th>
                                    <th>Date of Birth</th>
                                    <th>Status</th>
                                    <th>NOK Name</th>
                                    <th>NOK Phone</th>
                                    <th>NOK Relationship</th>
                                    <th>Rep</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

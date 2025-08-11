@extends('layouts.admin.app')
@section('title', 'Reps')
@section('content-header', 'Reps')
@section('content-header-description', 'Manage all representatives and their activities')
@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Reps Table</h3>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addRepModal">
                        <i class="fa fa-plus"></i> Add Rep
                    </button>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="repsDatatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Wallet Balance</th>
                                    <th>Status</th>
                                    <th>Users Count</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach($reps as $rep)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>
                                            <a href="{{ route('admin.repDetails', ['rep' => $rep->id]) }}" class="fw-bold">
                                                {{ $rep->name }}
                                            </a>
                                        </td>
                                        <td>{{ $rep->username }}</td>
                                        <td>{{ $rep->email }}</td>
                                        <td>{{ $rep->phone }}</td>
                                        <td>{{ number_format($rep->wallet_balance, 2) }}</td>
                                        <td>
                                            @if($rep->status === 'active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $rep->users_count ?? 0 }}</td>
                                        <td>{{ $rep->created_at ? $rep->created_at->format('d M Y') : '' }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editRepModal{{ $rep->id }}" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#changePasswordModal{{ $rep->id }}" title="Change Password">
                                                    <i class="fa fa-lock"></i>
                                                </button>
                                                <a href="{{ route('admin.repDetails', ['rep' => $rep->id]) }}" class="btn btn-sm btn-info" title="View Details">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="/admin/lockRep?rep_id={{ $rep->id }}" class="btn btn-sm {{ $rep->status === 'active' ? 'btn-danger' : 'btn-success' }}" title="{{ $rep->status === 'active' ? 'Lock' : 'Unlock' }}">
                                                    <i class="fa {{ $rep->status === 'active' ? 'fa-ban' : 'fa-unlock' }}"></i>
                                                </a>
                                                <a href="/admin/deleteRep/{{ $rep->id }}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this rep?')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
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
                                    <th>Phone</th>
                                    <th>Wallet Balance</th>
                                    <th>Status</th>
                                    <th>Users Count</th>
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

<!-- Add Rep Modal -->
<div class="modal fade" id="addRepModal" tabindex="-1" aria-labelledby="addRepModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRepModalLabel">Add New Rep</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.createRep') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Rep</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Rep Modals -->
@foreach($reps as $rep)
<div class="modal fade" id="editRepModal{{ $rep->id }}" tabindex="-1" aria-labelledby="editRepModalLabel{{ $rep->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRepModalLabel{{ $rep->id }}">Edit Rep: {{ $rep->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.updateRepProfile', ['repID' => $rep->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name{{ $rep->id }}" class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" id="name{{ $rep->id }}" value="{{ $rep->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="username{{ $rep->id }}" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username{{ $rep->id }}" value="{{ $rep->username }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email{{ $rep->id }}" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email{{ $rep->id }}" value="{{ $rep->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone{{ $rep->id }}" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone{{ $rep->id }}" value="{{ $rep->phone }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="status{{ $rep->id }}" class="form-label">Status</label>
                        <select class="form-control" name="status" id="status{{ $rep->id }}">
                            <option value="active" {{ $rep->status === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $rep->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Rep</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Password Modals -->
<div class="modal fade" id="changePasswordModal{{ $rep->id }}" tabindex="-1" aria-labelledby="changePasswordModalLabel{{ $rep->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel{{ $rep->id }}">Change Password: {{ $rep->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.updateRepPassword', ['repID' => $rep->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="password{{ $rep->id }}" class="form-label">New Password</label>
                        <input type="password" class="form-control" name="password" id="password{{ $rep->id }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation{{ $rep->id }}" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation{{ $rep->id }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

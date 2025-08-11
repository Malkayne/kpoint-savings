@extends('layouts.rep.app')
@section('title', 'Contribution Plans')
@section('content-header', 'Contribution Plans')
@section('content-header-description', 'Manage all your users\' contribution plans and progress')
@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Contribution Plans Table</h3>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPlanModal">
                        <i class="fa fa-plus"></i> New Plan
                    </button>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="plansDatatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                    <th>Start Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach($plans as $plan)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td><a href="{{ route('rep.userDetails', ['user' => $plan->user->id]) }}" class="fw-bold">{{ $plan->user->name }}</a></td>
                                        <td><a href="{{ route('rep.planDetails', ['plan' => $plan->id]) }}" class="fw-bold">{{ $plan->title }}</a></td>
                                        <td>₦{{ number_format($plan->amount, 2) }}</td>
                                        <td>{{ $plan->duration }} days</td>
                                        <td>
                                            @if($plan->status === 'active')
                                                <span class="badge bg-success">Active</span>
                                            @elseif($plan->status === 'completed')
                                                <span class="badge bg-info">Completed</span>
                                            @else
                                                <span class="badge bg-warning">Broken</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $progress = $plan->contributions->count();
                                                $percentage = $plan->duration > 0 ? ($progress / $plan->duration) * 100 : 0;
                                            @endphp
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%" 
                                                     aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                                    {{ $progress }}/{{ $plan->duration }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $plan->start_date ? date('d M Y', strtotime($plan->start_date)) : '' }}</td>
                                        <td>
                                            <a href="{{ route('rep.planDetails', ['plan' => $plan->id]) }}" class="btn btn-sm btn-info" title="View Details">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary" title="Edit" data-bs-toggle="modal" data-bs-target="#editPlanModal{{ $plan->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deletePlanModal{{ $plan->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Plan Modal -->
                                    <div class="modal fade" id="editPlanModal{{ $plan->id }}" tabindex="-1" role="dialog" aria-labelledby="editPlanModalLabel{{ $plan->id }}" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <form action="{{ route('rep.updatePlan', ['plan' => $plan->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="editPlanModalLabel{{ $plan->id }}">Edit Plan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="form-group">
                                                    <label>User</label>
                                                    <select name="user_id" class="form-control" required>
                                                        @foreach($users as $user)
                                                            <option value="{{ $user->id }}" {{ $plan->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" name="title" class="form-control" value="{{ $plan->title }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Amount</label>
                                                    <input type="number" name="amount" class="form-control" value="{{ $plan->amount }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Duration (days)</label>
                                                    <input type="number" name="duration" class="form-control" value="{{ $plan->duration }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea name="description" class="form-control">{{ $plan->description }}</textarea>
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                              </div>
                                            </div>
                                        </form>
                                      </div>
                                    </div>

                                    <!-- Delete Plan Modal -->
                                    <div class="modal fade" id="deletePlanModal{{ $plan->id }}" tabindex="-1" role="dialog" aria-labelledby="deletePlanModalLabel{{ $plan->id }}" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <form action="{{ route('rep.deletePlan', ['plan' => $plan->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="deletePlanModalLabel{{ $plan->id }}">Delete Plan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                Are you sure you want to delete the plan <strong>{{ $plan->title }}</strong>?
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                              </div>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                    <th>Start Date</th>
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

<!-- Create Plan Modal -->
<div class="modal fade" id="createPlanModal" tabindex="-1" role="dialog" aria-labelledby="createPlanModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('rep.createPlan') }}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createPlanModalLabel">Create New Plan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label>User</label>
                <select name="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Amount</label>
                <input type="number" name="amount" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Duration (days)</label>
                <input type="number" name="duration" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </div>
    </form>
  </div>
</div>
@endsection 
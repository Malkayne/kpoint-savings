@extends('layouts.admin.app')
@section('title', 'Contribution Plans')
@section('content-header', 'Contribution Plans')
@section('content-header-description', 'Manage all contribution plans and their progress')
@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contribution Plans Table</h3>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="plansDatatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Rep</th>
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
                                        <td>
                                            <a href="{{ route('admin.userDetails', ['user' => $plan->user->id]) }}" class="fw-bold">
                                                {{ $plan->user->name }}
                                            </a>
                                        </td>
                                        <td>{{ $plan->rep->name }}</td>
                                        <td>{{ $plan->title }}</td>
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
                                            <a href="{{ route('admin.userDetails', ['user' => $plan->user->id]) }}" class="btn btn-sm btn-info" title="View User Details">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-warning" title="Break Plan" 
                                                    onclick="breakPlan({{ $plan->id }}, '{{ $plan->title }}')">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Rep</th>
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

<script>
function breakPlan(planId, planTitle) {
    if (confirm('Are you sure you want to break the plan: ' + planTitle + '?')) {
        window.location.href = '/admin/breakPlan/' + planId;
    }
}
</script>
@endsection 
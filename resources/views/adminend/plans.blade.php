@extends('layouts.admin.app')
@section('title', 'Contribution Plans')
@section('content-header', 'Contribution Plans')
@section('content-header-description', 'Manage all contribution plans and their progress')
@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <!-- Plan Statistics -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fa fa-play text-success" style="font-size: 2rem;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="mb-0">{{ $plans->where('status', 'active')->count() }}</h4>
                            <p class="text-muted mb-0">Active Plans</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fa fa-check text-info" style="font-size: 2rem;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="mb-0">{{ $plans->where('status', 'completed')->count() }}</h4>
                            <p class="text-muted mb-0">Completed Plans</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fa fa-times text-warning" style="font-size: 2rem;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="mb-0">{{ $plans->where('status', 'broken')->count() }}</h4>
                            <p class="text-muted mb-0">Broken Plans</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fa fa-list text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="mb-0">{{ $plans->count() }}</h4>
                            <p class="text-muted mb-0">Total Plans</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Users & Their Contribution Plans</h3>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" title="Filter Plans">
                            <i class="fa fa-filter"></i> Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.plans') }}">All Plans</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.plans') }}?status=active">Active Plans</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.plans') }}?status=completed">Completed Plans</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.plans') }}?status=broken">Broken Plans</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="plansDatatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Rep</th>
                                    <th>Total Plans</th>
                                    <th>Active Plans</th>
                                    <th>Completed Plans</th>
                                    <th>Broken Plans</th>
                                    <th>Total Plan Amount</th>
                                    <th>Total Contributed</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach($usersWithPlans as $userData)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>
                                            <a href="{{ route('admin.userDetails', ['user' => $userData['user']->id]) }}" class="fw-bold">
                                                {{ $userData['user']->name }}
                                            </a>
                                            <br>
                                            <small class="text-muted">{{ $userData['user']->email }}</small>
                                        </td>
                                        <td>{{ $userData['user']->rep->name ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $userData['plan_counts']['total'] }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ $userData['plan_counts']['active'] }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $userData['plan_counts']['completed'] }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-warning">{{ $userData['plan_counts']['broken'] }}</span>
                                        </td>
                                        <td>₦{{ number_format($userData['total_amount'], 2) }}</td>
                                        <td>₦{{ number_format($userData['total_contributed'], 2) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" title="View Plans" data-bs-toggle="modal" data-bs-target="#userPlansModal{{ $userData['user']->id }}">
                                                <i class="fa fa-eye"></i> View Plans
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
                                    <th>Total Plans</th>
                                    <th>Active Plans</th>
                                    <th>Completed Plans</th>
                                    <th>Broken Plans</th>
                                    <th>Total Plan Amount</th>
                                    <th>Total Contributed</th>
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

<!-- User Plans Modals -->
@foreach($usersWithPlans as $userData)
    <div class="modal fade" id="userPlansModal{{ $userData['user']->id }}" tabindex="-1" role="dialog" aria-labelledby="userPlansModalLabel{{ $userData['user']->id }}" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userPlansModalLabel{{ $userData['user']->id }}">
                        Plans for {{ $userData['user']->name }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $userData['plan_counts']['total'] }}</h4>
                                    <p class="mb-0">Total Plans</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $userData['plan_counts']['active'] }}</h4>
                                    <p class="mb-0">Active Plans</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $userData['plan_counts']['completed'] }}</h4>
                                    <p class="mb-0">Completed Plans</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $userData['plan_counts']['broken'] }}</h4>
                                    <p class="mb-0">Broken Plans</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: #fff;">
                                <div class="card-body text-center">
                                    <h4 style="color: #fff;">₦{{ number_format($userData['total_amount'], 0) }}</h4>
                                    <p class="mb-0" style="color: #fff;">Total Plan Amount</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="background: linear-gradient(135deg, #4e54c8 0%, #8f94fb 100%); color: #fff;">
                                <div class="card-body text-center">
                                    <h4 style="color: #fff;">₦{{ number_format($userData['total_contributed'], 0) }}</h4>
                                    <p class="mb-0" style="color: #fff;">Contributed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($userData['plans']->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
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
                                    @foreach($userData['plans'] as $plan)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.planDetails', ['plan' => $plan->id]) }}" class="fw-bold">
                                                    {{ $plan->title }}
                                                </a>
                                            </td>
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
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.planDetails', ['plan' => $plan->id]) }}" class="btn btn-sm btn-info" title="View Details">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    
                                                    <!-- Status-based actions -->
                                                    @if($plan->status === 'active')
                                                        <button type="button" class="btn btn-sm btn-success" title="Complete Plan" 
                                                                onclick="completePlan({{ $plan->id }}, '{{ $plan->title }}')">
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-warning" title="Break Plan" 
                                                                onclick="breakPlan({{ $plan->id }}, '{{ $plan->title }}')">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    @elseif($plan->status === 'broken')
                                                        <button type="button" class="btn btn-sm btn-primary" title="Reactivate Plan" 
                                                                onclick="reactivatePlan({{ $plan->id }}, '{{ $plan->title }}')">
                                                            <i class="fa fa-refresh"></i>
                                                        </button>
                                                    @elseif($plan->status === 'completed')
                                                        <button type="button" class="btn btn-sm btn-warning" title="Break Plan" 
                                                                onclick="breakPlan({{ $plan->id }}, '{{ $plan->title }}')">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    @endif
                                                    
                                                    <!-- Quick Status Change Dropdown -->
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" title="Change Status">
                                                            <i class="fa fa-cog"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="#" onclick="changePlanStatus({{ $plan->id }}, 'active')">
                                                                <i class="fa fa-play text-success"></i> Set Active
                                                            </a></li>
                                                            @if($plan->status === 'active')
                                                            <li><a class="dropdown-item" href="#" onclick="changePlanStatus({{ $plan->id }}, 'completed')">
                                                                <i class="fa fa-check text-info"></i> Mark Completed
                                                            </a></li>
                                                            <li><a class="dropdown-item" href="#" onclick="changePlanStatus({{ $plan->id }}, 'broken')">
                                                                <i class="fa fa-times text-warning"></i> Break Plan
                                                            </a></li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li><a class="dropdown-item text-danger" href="#" onclick="deletePlan({{ $plan->id }}, '{{ $plan->title }}')">
                                                                <i class="fa fa-trash"></i> Delete Plan
                                                            </a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fa fa-folder-open fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No plans found for this user</h5>
                            <p class="text-muted">This user doesn't have any contribution plans yet.</p>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
function breakPlan(planId, planTitle) {
    if (confirm('Are you sure you want to break the plan: ' + planTitle + '?')) {
        window.location.href = '/admin/breakPlan/' + planId;
    }
}

function completePlan(planId, planTitle) {
    if (confirm('Are you sure you want to mark the plan as completed: ' + planTitle + '?')) {
        window.location.href = '/admin/completePlan/' + planId;
    }
}

function reactivatePlan(planId, planTitle) {
    if (confirm('Are you sure you want to reactivate the plan: ' + planTitle + '?')) {
        window.location.href = '/admin/reactivatePlan/' + planId;
    }
}

function changePlanStatus(planId, status) {
    const statusMessages = {
        'active': 'activate',
        'completed': 'mark as completed',
        'broken': 'break'
    };
    
    if (confirm('Are you sure you want to ' + statusMessages[status] + ' this plan?')) {
        // Create a form to submit the status change
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/updatePlanStatus/' + planId;
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        // Add status
        const statusInput = document.createElement('input');
        statusInput.type = 'hidden';
        statusInput.name = 'status';
        statusInput.value = status;
        form.appendChild(statusInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}

function deletePlan(planId, planTitle) {
    if (confirm('Are you sure you want to DELETE the plan: ' + planTitle + '?\n\nThis action cannot be undone and will only work if the plan has no contributions.')) {
        // Create a form to submit the delete request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/deletePlan/' + planId;
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        // Add method override for DELETE
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection 
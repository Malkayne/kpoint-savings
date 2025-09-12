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
                    <h3 class="card-title">Users & Their Contribution Plans</h3>
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
                                            <a href="{{ route('rep.userDetails', ['user' => $userData['user']->id]) }}" class="fw-bold">
                                                {{ $userData['user']->name }}
                                            </a>
                                            <br>
                                            <small class="text-muted">{{ $userData['user']->email }}</small>
                                        </td>
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
                                                <a href="{{ route('rep.planDetails', ['plan' => $plan->id]) }}" class="fw-bold">
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

<!-- Edit and Delete Plan Modals -->
@foreach($usersWithPlans as $userData)
    @foreach($userData['plans'] as $plan)
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
                        <div class="user-search-container">
                            <input type="text" class="form-control edit-user-search" id="userSearch{{ $plan->id }}" placeholder="Search users by name, email, username, or phone..." autocomplete="off" required>
                            <div id="userSearchResults{{ $plan->id }}" class="search-results"></div>
                            <input type="hidden" name="user_id" id="selectedUserId{{ $plan->id }}" value="{{ $plan->user_id }}" required>
                            <div id="selectedUser{{ $plan->id }}" class="selected-user mt-2">
                                <span class="badge bg-primary">{{ $plan->user->name }} ({{ $plan->user->email }})</span>
                            </div>
                        </div>
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
@endforeach

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
                <div class="user-search-container">
                    <input type="text" class="form-control" id="userSearch" placeholder="Search users by name, email, username, or phone..." autocomplete="off" required>
                    <div id="userSearchResults" class="search-results"></div>
                    <input type="hidden" name="user_id" id="selectedUserId" required>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    let userSearch = document.getElementById('userSearch');
                    let userSearchResults = document.getElementById('userSearchResults');
                    let selectedUserId = document.getElementById('selectedUserId');
                    let currentRequest = null;

                    userSearch.addEventListener('input', function () {
                        let query = this.value.trim();
                        selectedUserId.value = '';
                        if (query.length < 2) {
                            userSearchResults.style.display = 'none';
                            userSearchResults.innerHTML = '';
                            return;
                        }
                        if (currentRequest) currentRequest.abort();
                        currentRequest = new XMLHttpRequest();
                        currentRequest.open('GET', '/rep/search-users?q=' + encodeURIComponent(query), true);
                        currentRequest.onreadystatechange = function () {
                            if (currentRequest.readyState === 4 && currentRequest.status === 200) {
                                let users = JSON.parse(currentRequest.responseText);
                                userSearchResults.innerHTML = '';
                                if (users.length > 0) {
                                    users.forEach(function (user) {
                                        let div = document.createElement('div');
                                        div.className = 'search-result-item';
                                        div.textContent = user.name + ' (' + user.email + ')';
                                        div.dataset.userId = user.id;
                                        div.dataset.userName = user.name;
                                        div.dataset.userEmail = user.email;
                                        div.addEventListener('click', function () {
                                            userSearch.value = user.name + ' (' + user.email + ')';
                                            selectedUserId.value = user.id;
                                            userSearchResults.style.display = 'none';
                                            userSearchResults.innerHTML = '';
                                            userSearch.readOnly = true;
                                        });
                                        userSearchResults.appendChild(div);
                                    });
                                    userSearchResults.style.display = 'block';
                                } else {
                                    userSearchResults.style.display = 'none';
                                }
                            }
                        };
                        currentRequest.send();
                    });

                    // Allow user to clear selection by focusing and pressing backspace/delete
                    userSearch.addEventListener('focus', function () {
                        if (userSearch.readOnly) {
                            setTimeout(function () {
                                userSearch.select();
                            }, 10);
                        }
                    });
                    userSearch.addEventListener('keydown', function (e) {
                        if (userSearch.readOnly && (e.key === 'Backspace' || e.key === 'Delete')) {
                            userSearch.value = '';
                            selectedUserId.value = '';
                            userSearch.readOnly = false;
                            userSearchResults.style.display = 'none';
                            userSearchResults.innerHTML = '';
                            e.preventDefault();
                        }
                    });

                    // Hide results if clicking outside
                    document.addEventListener('click', function (e) {
                        if (!userSearch.contains(e.target) && !userSearchResults.contains(e.target)) {
                            userSearchResults.style.display = 'none';
                        }
                    });
                });
            </script>
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

<style>
.user-search-container {
    position: relative;
}

.search-results {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #ddd;
    border-top: none;
    max-height: 200px;
    overflow-y: auto;
    z-index: 1000;
    display: none;
}

.search-result-item {
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid #eee;
}

.search-result-item:hover {
    background-color: #f5f5f5;
}

.search-result-item:last-child {
    border-bottom: none;
}

.selected-user {
    display: flex;
    align-items: center;
    gap: 5px;
}

.selected-user .badge {
    font-size: 12px;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let searchTimeout;

    // Load initial users when create modal opens
    $('#createPlanModal').on('shown.bs.modal', function() {
        loadInitialUsers('userSearchResults', 'selectedUserId', 'selectedUser');
    });

    // Load initial users when edit modal opens
    $(document).on('shown.bs.modal', '.modal', function() {
        const modalId = $(this).attr('id');
        if (modalId && modalId.startsWith('editPlanModal')) {
            const planId = modalId.replace('editPlanModal', '');
            loadInitialUsers('userSearchResults' + planId, 'selectedUserId' + planId, 'selectedUser' + planId);
        }
    });

    // User search functionality for create modal
    $('#userSearch').on('input', function() {
        const query = $(this).val();
        
        clearTimeout(searchTimeout);
        
        searchTimeout = setTimeout(function() {
            searchUsers(query, 'userSearchResults', 'selectedUserId', 'selectedUser');
        }, 200);
    });

    // User search functionality for edit modals
    $(document).on('input', '.edit-user-search', function() {
        const query = $(this).val();
        const modalId = $(this).attr('id').replace('userSearch', '');
        
        clearTimeout(searchTimeout);
        
        searchTimeout = setTimeout(function() {
            searchUsers(query, 'userSearchResults' + modalId, 'selectedUserId' + modalId, 'selectedUser' + modalId);
        }, 200);
    });

    function loadInitialUsers(resultsId, userIdId, selectedUserId) {
        searchUsers('', resultsId, userIdId, selectedUserId);
    }

    function searchUsers(query, resultsId, userIdId, selectedUserId) {
        $.ajax({
            url: '{{ route("rep.searchUsers") }}',
            method: 'GET',
            data: { q: query },
            success: function(users) {
                displaySearchResults(users, resultsId, userIdId, selectedUserId);
            },
            error: function(xhr, status, error) {
                console.error('Error searching users:', error);
                $('#' + resultsId).html('<div class="search-result-item text-danger">Error loading users</div>').show();
            }
        });
    }

    function displaySearchResults(users, resultsId, userIdId, selectedUserId) {
        const resultsContainer = $('#' + resultsId);
        resultsContainer.empty();
        
        if (users.length === 0) {
            resultsContainer.html('<div class="search-result-item">No users found</div>');
        } else {
            users.forEach(function(user) {
                const resultItem = $(`
                    <div class="search-result-item" data-user-id="${user.id}">
                        <strong>${user.name}</strong><br>
                        <small>${user.email} | ${user.username} | ${user.phone || 'No phone'}</small>
                    </div>
                `);
                resultsContainer.append(resultItem);
            });
        }
        
        resultsContainer.show();
    }

    // Handle user selection for create modal
    $(document).on('click', '#userSearchResults .search-result-item', function() {
        const userId = $(this).data('user-id');
        const userName = $(this).find('strong').text();
        const userEmail = $(this).find('small').text().split(' | ')[0];
        
        $('#selectedUserId').val(userId);
        $('#selectedUser').html(`<span class="badge bg-primary">${userName} (${userEmail})</span>`).show();
        
        // Fill the search input with selected user info
        $('#userSearch').val(`${userName} (${userEmail})`);
        
        // Hide results
        $('#userSearchResults').hide();
    });

    // Handle user selection for edit modals
    $(document).on('click', '.search-results .search-result-item', function() {
        const userId = $(this).data('user-id');
        const userName = $(this).find('strong').text();
        const userEmail = $(this).find('small').text().split(' | ')[0];
        const modalId = $(this).closest('.search-results').attr('id').replace('userSearchResults', '');
        
        $('#selectedUserId' + modalId).val(userId);
        $('#selectedUser' + modalId).html(`<span class="badge bg-primary">${userName} (${userEmail})</span>`).show();
        
        // Fill the search input with selected user info
        $('#userSearch' + modalId).val(`${userName} (${userEmail})`);
        
        // Hide results
        $('#userSearchResults' + modalId).hide();
    });

    // Hide search results when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.user-search-container').length) {
            $('.search-results').hide();
        }
    });

    // Clear selected user when modal is closed
    $('#createPlanModal').on('hidden.bs.modal', function() {
        $('#userSearch').val('');
        $('#selectedUserId').val('');
        $('#selectedUser').hide();
        $('#userSearchResults').hide();
    });

    // Focus on search input when modal opens
    $('#createPlanModal').on('shown.bs.modal', function() {
        setTimeout(function() {
            $('#userSearch').focus();
        }, 300);
    });
});
</script> 
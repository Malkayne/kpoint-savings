@extends('layouts.users.app')
@section('title', 'Plan Details')
@section('content-header', 'Plan Details')
@section('content-header-description', 'View detailed information about your contribution plan')
@section('content')

<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title">Plan Information</h4>
                </div>
                <div class="card-body">
                    <!-- plan user -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">User</label>
                        <p class="mb-0">
                            <a href="{{ route('admin.userDetails', ['user' => $plan->user->id]) }}" class="fw-bold">
                                {{ $plan->user->name . ' (' . $plan->user->username . ')' }}
                            </a>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Representative</label>
                        <p class="mb-0">
                            <a href="{{ route('admin.repDetails', ['rep' => $plan->rep->id]) }}" class="fw-bold">
                                {{ $plan->rep->name . ' (' . $plan->rep->username . ')' }}
                            </a>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Title</label>
                        <p class="mb-0">{{ $plan->title }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Amount per Day</label>
                        <p class="mb-0">₦{{ number_format($plan->amount, 2) }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Duration</label>
                        <p class="mb-0">{{ $plan->duration }} days</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p class="mb-0">
                            <span class="badge 
                                @if($plan->status === 'active') bg-success
                                @elseif($plan->status === 'completed') bg-info
                                @else bg-warning
                                @endif">
                                {{ ucfirst($plan->status) }}
                            </span>
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Start Date</label>
                        <p class="mb-0">{{ $plan->start_date ? date('d M Y', strtotime($plan->start_date)) : 'N/A' }}</p>
                    </div>
                    
                    @if($plan->description)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <p class="mb-0">{{ $plan->description }}</p>
                        </div>
                    @endif
                    
                    <hr>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Total Contributed</label>
                        <p class="mb-0">₦{{ number_format($plan->contributions->sum('amount'), 2) }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Days Completed</label>
                        <p class="mb-0">{{ $plan->contributions->count() }} / {{ $plan->duration }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Progress</label>
                        <div class="progress" style="height: 10px;">
                            @php
                                $progress = $plan->duration > 0 ? ($plan->contributions->count() / $plan->duration) * 100 : 0;
                            @endphp
                            <div class="progress-bar 
                                @if($progress >= 100) bg-success
                                @elseif($progress >= 50) bg-warning
                                @else bg-info
                                @endif" 
                                role="progressbar" 
                                style="width: {{ $progress }}%" 
                                aria-valuenow="{{ $progress }}" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                                {{ round($progress, 1) }}%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title">Contribution Calendar</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    @php
                                        $start = $plan->start_date ? \Carbon\Carbon::parse($plan->start_date) : null;
                                        $contribDays = collect($plan->contributions)->pluck('contributed_on')->map(function($date) {
                                            return \Carbon\Carbon::parse($date)->format('Y-m-d');
                                        })->toArray();
                                    @endphp
                                    @for($i = 0; $i < $plan->duration; $i++)
                                        @php
                                            $dayDate = $start ? $start->copy()->addDays($i)->format('Y-m-d') : null;
                                            $contrib = in_array($dayDate, $contribDays);
                                        @endphp
                                        <th class="text-center">
                                            <small>{{ $start ? $start->copy()->addDays($i)->format('d') : '' }}</small>
                                        </th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    @for($i = 0; $i < $plan->duration; $i++)
                                        @php
                                            $dayDate = $start ? $start->copy()->addDays($i)->format('Y-m-d') : null;
                                            $contrib = in_array($dayDate, $contribDays);
                                        @endphp
                                        <td class="text-center">
                                            @if($contrib)
                                                <span class="badge bg-success" data-bs-toggle="tooltip" title="Contributed on {{ $dayDate }}">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                            @else
                                                <span class="badge bg-danger" data-bs-toggle="tooltip" title="No contribution">
                                                    <i class="fas fa-times"></i>
                                                </span>
                                            @endif
                                        </td>
                                    @endfor
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Contribution History</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Recorded At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @forelse($plan->contributions as $contribution)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>{{ $contribution->contributed_on ? date('d M Y', strtotime($contribution->contributed_on)) : '' }}</td>
                                        <td>₦{{ number_format($contribution->amount, 2) }}</td>
                                        <td>{{ $contribution->description ?? 'N/A' }}</td>
                                        <td>{{ $contribution->created_at ? $contribution->created_at->format('d M Y H:i') : '' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No contributions found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 
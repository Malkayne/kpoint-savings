@extends('layouts.users.app')
@section('title', 'My Plans')
@section('content-header', 'My Plans')
@section('content-header-description', 'View all your contribution plans and their progress')
@section('content')

<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
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

            <div class="row">
                @forelse($plans as $plan)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">{{ $plan->title }}</h5>
                                <span class="badge 
                                    @if($plan->status === 'active') bg-success
                                    @elseif($plan->status === 'completed') bg-info
                                    @else bg-warning
                                    @endif">
                                    {{ ucfirst($plan->status) }}
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <small class="text-muted">Amount per Day</small>
                                        <h6 class="mb-0">₦{{ number_format($plan->amount, 2) }}</h6>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Duration</small>
                                        <h6 class="mb-0">{{ $plan->duration }} days</h6>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <small class="text-muted">Progress</small>
                                        <h6 class="mb-0">{{ $plan->contributions->count() }}/{{ $plan->duration }}</h6>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Total Contributed</small>
                                        <h6 class="mb-0">₦{{ number_format($plan->contributions->sum('amount'), 2) }}</h6>
                                    </div>
                                </div>

                                @if($plan->description)
                                    <p class="text-muted small mb-3">{{ $plan->description }}</p>
                                @endif

                                <div class="progress mb-3" style="height: 8px;">
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
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        Started: {{ $plan->start_date ? date('d M Y', strtotime($plan->start_date)) : 'N/A' }}
                                    </small>
                                    <a href="{{ route('userend.planDetails', ['plan' => $plan->id]) }}" 
                                       class="btn btn-primary btn-sm">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No Plans Found</h5>
                                <p class="text-muted">You don't have any contribution plans yet. Contact your representative to create one.</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection 
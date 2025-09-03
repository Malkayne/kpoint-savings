@extends('layouts.rep.app')
@section('title', 'Plan Details')
@section('content-header', 'Plan Details')
@section('content-header-description', 'View and manage contributions for this plan')
@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title">Plan Info</h4>
                </div>
                <div class="card-body">
                    <p><strong>User:</strong> <a href="{{ route('rep.userDetails', ['user' => $plan->user->id]) }}" class="fw-bold">{{ $plan->user->name }}</a></p>
                    <p><strong>Title:</strong> {{ $plan->title }}</p>
                    <p><strong>Amount per Day:</strong> ₦{{ number_format($plan->amount, 2) }}</p>
                    <p><strong>Duration:</strong> {{ $plan->duration }} days</p>
                    <p><strong>Status:</strong> 
                        @if($plan->status === 'active')
                            <span class="badge bg-success">Active</span>
                        @elseif($plan->status === 'completed')
                            <span class="badge bg-info">Completed</span>
                        @else
                            <span class="badge bg-warning">Broken</span>
                        @endif
                    </p>
                    <p><strong>Start Date:</strong> {{ $plan->start_date ? date('d M Y', strtotime($plan->start_date)) : '' }}</p>
                    <p><strong>Description:</strong> {{ $plan->description ?? 'N/A' }}</p>
                    <hr>
                    <p><strong>Total Contributed:</strong> ₦{{ number_format($plan->contributions->sum('amount'), 2) }}</p>
                    <p><strong>Days Completed:</strong> {{ $plan->contributions->count() }} / {{ $plan->duration }}</p>
                    <p><strong>Days Remaining:</strong> {{ max(0, $plan->duration - $plan->contributions->count()) }}</p>
                </div>
            </div>
            @if($plan->status === 'active')
            <button class="btn btn-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#contributeModal">
                <i class="fa fa-plus"></i> Make Contribution
            </button>
            <button class="btn btn-secondary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#revisitModal">
                <i class="fa fa-calendar"></i> Revisit Skipped Days
            </button>
            @endif
        </div>
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title">Contribution Calendar</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    @for($i = 1; $i <= $plan->duration; $i++)
                                        <th>Day {{ $i }}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @php
                                        $contribDays = $plan->contributions->pluck('contributed_on')->map(function($date) {
                                            return \Carbon\Carbon::parse($date)->format('Y-m-d');
                                        })->toArray();
                                        $start = $plan->start_date ? \Carbon\Carbon::parse($plan->start_date) : null;
                                    @endphp
                                    @for($i = 0; $i < $plan->duration; $i++)
                                        @php
                                            $dayDate = $start ? $start->copy()->addDays($i)->format('Y-m-d') : null;
                                            $contrib = in_array($dayDate, $contribDays);
                                        @endphp
                                        <td>
                                            @if($contrib)
                                                <span class="badge bg-success" data-bs-toggle="tooltip" title="Contributed on {{ $dayDate }}">✔</span>
                                            @else
                                                <span class="badge bg-danger" data-bs-toggle="tooltip" title="No contribution">✗</span>
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
                                @foreach($plan->contributions as $contribution)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>{{ $contribution->contributed_on ? date('d M Y', strtotime($contribution->contributed_on)) : '' }}</td>
                                        <td>₦{{ number_format($contribution->amount, 2) }}</td>
                                        <td>{{ $contribution->description ?? 'N/A' }}</td>
                                        <td>{{ $contribution->created_at ? $contribution->created_at->format('d M Y H:i') : '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Make Contribution Modal -->
<div class="modal fade" id="contributeModal" tabindex="-1" role="dialog" aria-labelledby="contributeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('rep.makeContribution', ['plan' => $plan->id]) }}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="contributeModalLabel">Make Contribution</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label>Date (today)</label>
                <input type="text" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
            </div>
            <div class="form-group">
                <label>Amount</label>
                <input type="number" name="amount" class="form-control" value="{{ $plan->amount }}" required readonly>
            </div>
            <div class="form-group">
                <label>Description (optional)</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Contribute</button>
          </div>
        </div>
    </form>
  </div>
</div>

<!-- Revisit Skipped Day Modal -->
<div class="modal fade" id="revisitModal" tabindex="-1" role="dialog" aria-labelledby="revisitModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('rep.revisitContribution', ['plan' => $plan->id]) }}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="revisitModalLabel">Revisit Skipped Days</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label>Select Skipped Dates (Hold Ctrl/Cmd to select multiple)</label>
                <select name="contributed_on[]" class="form-control" multiple required style="height: 200px;">
                    @php
                        $start = $plan->start_date ? \Carbon\Carbon::parse($plan->start_date) : null;
                        $contribDays = $plan->contributions->pluck('contributed_on')->map(function($date) {
                            return \Carbon\Carbon::parse($date)->format('Y-m-d');
                        })->toArray();
                    @endphp
                    @for($i = 0; $i < $plan->duration; $i++)
                        @php $dayDate = $start ? $start->copy()->addDays($i)->format('Y-m-d') : null; @endphp
                        @if($dayDate && !in_array($dayDate, $contribDays))
                            <option value="{{ $dayDate }}">{{ $dayDate }}</option>
                        @endif
                    @endfor
                </select>
                <small class="form-text text-muted">You can select multiple dates by holding Ctrl (Windows) or Cmd (Mac) while clicking.</small>
            </div>
            <div class="form-group">
                <label>Amount</label>
                <input type="number" name="amount" class="form-control" value="{{ $plan->amount }}" required readonly>
            </div>
            <div class="form-group">
                <label>Description (optional)</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" id="submitBtn">Add Contributions</button>
          </div>
        </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectElement = document.querySelector('select[name="contributed_on[]"]');
    const submitBtn = document.getElementById('submitBtn');
    
    if (selectElement && submitBtn) {
        function updateButtonText() {
            const selectedCount = selectElement.selectedOptions.length;
            if (selectedCount === 0) {
                submitBtn.textContent = 'Add Contributions';
                submitBtn.disabled = true;
            } else if (selectedCount === 1) {
                submitBtn.textContent = 'Add 1 Contribution';
                submitBtn.disabled = false;
            } else {
                submitBtn.textContent = `Add ${selectedCount} Contributions`;
                submitBtn.disabled = false;
            }
        }
        
        selectElement.addEventListener('change', updateButtonText);
        updateButtonText(); // Initial call
    }
});
</script>
@endsection 
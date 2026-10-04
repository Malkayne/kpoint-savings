@extends('superadmin.layouts.app')
@section('title', 'Dashboard')
@section('content-header', 'Platform dashboard')
@section('content-header-description', 'Organisations, members, and balances across the product')
@section('header-action')
    <a href="{{ route('superadmin.orgs.create') }}" class="btn btn-primary">New organisation</a>
@endsection
@section('content')
<div class="row g-4 sa-gap">
    <div class="col-sm-6 col-xl">
        <div class="card h-100 mb-0">
            <div class="card-body">
                <div class="progress-widget">
                    <div class="text-center circle-progress-01 circle-progress circle-progress-primary">
                        <i class="fas fa-building fs-2 text-primary"></i>
                    </div>
                    <div class="progress-detail">
                        <p class="mb-2">Organisations</p>
                        <h4 class="counter mb-0">{{ $totalOrgs }}</h4>
                        <small class="text-muted">{{ $activeOrgs }} active</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl">
        <div class="card h-100 mb-0">
            <div class="card-body">
                <div class="progress-widget">
                    <div class="text-center circle-progress-01 circle-progress circle-progress-info">
                        <i class="fas fa-users fs-2 text-info"></i>
                    </div>
                    <div class="progress-detail">
                        <p class="mb-2">Members</p>
                        <h4 class="counter mb-0">{{ number_format($totalUsers) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl">
        <div class="card h-100 mb-0">
            <div class="card-body">
                <div class="progress-widget">
                    <div class="text-center circle-progress-01 circle-progress circle-progress-success">
                        <i class="fas fa-user-tie fs-2 text-success"></i>
                    </div>
                    <div class="progress-detail">
                        <p class="mb-2">Reps</p>
                        <h4 class="counter mb-0">{{ number_format($totalReps) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl">
        <div class="card h-100 mb-0">
            <div class="card-body">
                <div class="progress-widget">
                    <div class="text-center circle-progress-01 circle-progress circle-progress-warning">
                        <i class="fas fa-retweet fs-2 text-warning"></i>
                    </div>
                    <div class="progress-detail">
                        <p class="mb-2">Transactions</p>
                        <h4 class="counter mb-0">{{ number_format($totalTransactions) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl">
        <div class="card h-100 mb-0">
            <div class="card-body">
                <div class="progress-widget">
                    <div class="text-center circle-progress-01 circle-progress circle-progress-primary">
                        <i class="fas fa-wallet fs-2 text-primary"></i>
                    </div>
                    <div class="progress-detail">
                        <p class="mb-2">Member balances</p>
                        <h4 class="counter mb-0">₦{{ number_format($totalWallet, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 sa-gap">
    <div class="col-xl-8">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Credits and debits</h4>
                <p class="mb-0 text-muted">Last six months, every organisation</p>
            </div>
            <div class="card-body">
                <div id="flow-chart" style="min-height: 280px;"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Organisation status</h4>
            </div>
            <div class="card-body d-flex align-items-center">
                <div id="status-chart" class="w-100" style="min-height: 280px;"></div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 sa-gap">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Members and reps by organisation</h4>
            </div>
            <div class="card-body">
                <div id="people-chart" style="min-height: 280px;"></div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Organisations</h4>
        <a href="{{ route('superadmin.orgs') }}" class="btn btn-sm btn-outline-primary">View all</a>
    </div>
    <div class="card-body">
        <div class="custom-datatable-entries">
            <table class="table table-striped" data-toggle="data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Members</th>
                        <th>Reps</th>
                        <th>Transactions</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($orgs as $org)
                    <tr>
                        <td>
                            <a href="{{ route('superadmin.orgs.show', $org) }}" class="fw-bold">{{ $org->name }}</a>
                        </td>
                        <td>
                            @if($org->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif($org->status === 'suspended')
                                <span class="badge bg-danger">Suspended</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($org->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $org->users_count }}</td>
                        <td>{{ $org->reps_count }}</td>
                        <td>{{ $org->transactions_count }}</td>
                        <td>
                            @if($org->status === 'active')
                                <form method="POST" action="{{ route('superadmin.enter-org', $org) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-primary" type="submit">Enter</button>
                                </form>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    (function () {
        var chart = @json($chart);
        var purple = '#6f42c1';
        var teal = '#0d9488';
        var amber = '#d97706';

        new ApexCharts(document.querySelector('#flow-chart'), {
            chart: { type: 'area', height: 280, toolbar: { show: false }, fontFamily: 'inherit' },
            series: [
                { name: 'Credits', data: chart.credits },
                { name: 'Debits', data: chart.debits }
            ],
            colors: [teal, amber],
            stroke: { curve: 'smooth', width: 2 },
            dataLabels: { enabled: false },
            xaxis: { categories: chart.months },
            yaxis: { labels: { formatter: function (value) { return '₦' + Number(value).toLocaleString(); } } },
            tooltip: { y: { formatter: function (value) { return '₦' + Number(value).toLocaleString(undefined, { minimumFractionDigits: 2 }); } } },
            fill: { type: 'gradient', gradient: { opacityFrom: 0.35, opacityTo: 0.05 } },
            legend: { position: 'top' },
            noData: { text: 'No transactions yet' }
        }).render();

        new ApexCharts(document.querySelector('#status-chart'), {
            chart: { type: 'donut', height: 280, fontFamily: 'inherit' },
            series: chart.status,
            labels: ['Active', 'Suspended', 'Inactive'],
            colors: ['#198754', '#dc3545', '#6c757d'],
            legend: { position: 'bottom' },
            dataLabels: { enabled: true },
            plotOptions: { pie: { donut: { size: '68%', labels: { show: true, total: { show: true, label: 'Total' } } } } },
            noData: { text: 'No organisations yet' }
        }).render();

        new ApexCharts(document.querySelector('#people-chart'), {
            chart: { type: 'bar', height: 280, toolbar: { show: false }, fontFamily: 'inherit' },
            series: [
                { name: 'Members', data: chart.members },
                { name: 'Reps', data: chart.reps }
            ],
            colors: [purple, teal],
            plotOptions: { bar: { borderRadius: 4, columnWidth: '42%' } },
            dataLabels: { enabled: false },
            xaxis: { categories: chart.orgs.length ? chart.orgs : ['No organisations'] },
            legend: { position: 'top' },
            noData: { text: 'No organisations yet' }
        }).render();
    })();
</script>
@endpush

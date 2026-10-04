<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Models\Rep;
use App\Models\Transaction;
use App\Models\User;
use App\Scopes\OrganisationScope;
use Carbon\Carbon;

class DefaultController extends Controller
{
    public function index()
    {
        $totalOrgs = Organisation::count();
        $activeOrgs = Organisation::where('status', 'active')->count();
        $totalUsers = User::withoutTenantScope()->count();
        $totalReps = Rep::withoutTenantScope()->count();
        $totalTransactions = Transaction::withoutTenantScope()->count();
        $totalWallet = User::withoutTenantScope()->sum('wallet_balance');

        $orgs = Organisation::withCount([
            'users' => function ($query) {
                $query->withoutGlobalScope(OrganisationScope::class);
            },
            'reps' => function ($query) {
                $query->withoutGlobalScope(OrganisationScope::class);
            },
            'transactions' => function ($query) {
                $query->withoutGlobalScope(OrganisationScope::class);
            },
        ])->orderBy('name')->get();

        $suspendedOrgs = Organisation::where('status', 'suspended')->count();
        $inactiveOrgs = Organisation::where('status', 'inactive')->count();

        $monthStart = Carbon::now()->subMonths(5)->startOfMonth();
        $monthlyRows = Transaction::withoutTenantScope()
            ->where('created_at', '>=', $monthStart)
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as ym, type, SUM(amount) as total')
            ->groupBy(\DB::raw('DATE_FORMAT(created_at, "%Y-%m")'), 'type')
            ->get();

        $monthLabels = [];
        $creditSeries = [];
        $debitSeries = [];
        for ($i = 5; $i >= 0; $i--) {
            $point = Carbon::now()->subMonths($i);
            $key = $point->format('Y-m');
            $monthLabels[] = $point->format('M Y');
            $creditSeries[] = (float) $monthlyRows->where('ym', $key)->where('type', 'credit')->sum('total');
            $debitSeries[] = (float) $monthlyRows->where('ym', $key)->where('type', 'debit')->sum('total');
        }

        $chart = [
            'orgs' => $orgs->pluck('name')->values(),
            'members' => $orgs->pluck('users_count')->map(function ($count) {
                return (int) $count;
            })->values(),
            'reps' => $orgs->pluck('reps_count')->map(function ($count) {
                return (int) $count;
            })->values(),
            'months' => $monthLabels,
            'credits' => $creditSeries,
            'debits' => $debitSeries,
            'status' => [(int) $activeOrgs, (int) $suspendedOrgs, (int) $inactiveOrgs],
        ];

        return view('superadmin.dashboard', compact(
            'totalOrgs',
            'activeOrgs',
            'totalUsers',
            'totalReps',
            'totalTransactions',
            'totalWallet',
            'orgs',
            'chart'
        ));
    }
}

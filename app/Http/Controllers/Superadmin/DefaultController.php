<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Models\Rep;
use App\Models\Transaction;
use App\Models\User;
use App\Scopes\OrganisationScope;

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

        $recentOrgs = Organisation::latest()->limit(5)->get();

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
        ])->get();

        return view('superadmin.dashboard', compact(
            'totalOrgs',
            'activeOrgs',
            'totalUsers',
            'totalReps',
            'totalTransactions',
            'totalWallet',
            'recentOrgs',
            'orgs'
        ));
    }
}

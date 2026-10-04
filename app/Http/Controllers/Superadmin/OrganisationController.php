<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminWallet;
use App\Models\Organisation;
use App\Models\Transaction;
use App\Scopes\OrganisationScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class OrganisationController extends Controller
{
    public function index()
    {
        $orgs = Organisation::withCount([
            'users' => function ($query) {
                $query->withoutGlobalScope(OrganisationScope::class);
            },
            'reps' => function ($query) {
                $query->withoutGlobalScope(OrganisationScope::class);
            },
            'admins' => function ($query) {
                $query->withoutGlobalScope(OrganisationScope::class);
            },
        ])->orderBy('name')->get();

        return view('superadmin.orgs.index', compact('orgs'));
    }

    public function create()
    {
        return view('superadmin.orgs.create');
    }

    /**
     * Create an organisation, its first admin, and its treasury wallet.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:organisations,slug',
            'email' => 'nullable|email|max:255',
            'admin_name' => 'required|string|max:100',
            'admin_email' => 'required|email|max:100|unique:admins,email',
            'admin_username' => 'required|string|max:50|unique:admins,username',
            'admin_password' => 'required|string|min:8',
        ]);

        $org = DB::transaction(function () use ($request) {
            $org = Organisation::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'email' => $request->email,
                'status' => 'active',
            ]);

            $admin = $this->createOrgAdmin([
                'org_id' => $org->id,
                'name' => $request->admin_name,
                'email' => $request->admin_email,
                'username' => $request->admin_username,
                'password' => Hash::make($request->admin_password),
            ]);

            if (!Schema::hasTable('admin_wallets')) {
                throw new \RuntimeException('admin_wallets table is missing.');
            }

            AdminWallet::withoutTenantScope()->create([
                'org_id' => $org->id,
                'admin_id' => $admin->id,
                'amount' => 0,
            ]);

            return $org;
        });

        return redirect()->route('superadmin.orgs')
            ->with('success', "Organisation '{$org->name}' created successfully.");
    }

    public function show(Organisation $org)
    {
        $org->loadCount([
            'users' => function ($query) {
                $query->withoutGlobalScope(OrganisationScope::class);
            },
            'reps' => function ($query) {
                $query->withoutGlobalScope(OrganisationScope::class);
            },
            'admins' => function ($query) {
                $query->withoutGlobalScope(OrganisationScope::class);
            },
            'transactions' => function ($query) {
                $query->withoutGlobalScope(OrganisationScope::class);
            },
        ]);

        $recentTransactions = Transaction::withoutTenantScope()
            ->where('org_id', $org->id)
            ->with(['user' => function ($query) {
                $query->withoutGlobalScope(OrganisationScope::class);
            }])
            ->latest()
            ->limit(10)
            ->get();

        return view('superadmin.orgs.show', compact('org', 'recentTransactions'));
    }

    public function edit(Organisation $org)
    {
        return view('superadmin.orgs.edit', compact('org'));
    }

    public function update(Request $request, Organisation $org)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:organisations,slug,'.$org->id,
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'status' => 'required|in:active,suspended,inactive',
        ]);

        $org->update($request->only(['name', 'slug', 'email', 'phone', 'address', 'status']));

        return redirect()->route('superadmin.orgs.show', $org)
            ->with('success', "Organisation '{$org->name}' updated.");
    }

    public function suspend(Organisation $org)
    {
        $org->update(['status' => 'suspended']);

        return back()->with('success', "Organisation '{$org->name}' suspended.");
    }

    public function activate(Organisation $org)
    {
        $org->update(['status' => 'active']);

        return back()->with('success', "Organisation '{$org->name}' activated.");
    }

    /**
     * Enter an organisation. Later queries use the session org, not the request.
     */
    public function enterOrg(Request $request, Organisation $org)
    {
        if ($org->status !== 'active') {
            return back()->with('error', 'Cannot enter a suspended or inactive organisation.');
        }

        // Drop a previous org-admin login so ghost mode cannot inherit that organisation.
        Auth::guard('admin')->logout();

        $request->session()->put('acting_org_id', $org->id);
        $request->session()->put('acting_as_superadmin', true);

        return redirect('/admin/dashboard')
            ->with('success', "Entered '{$org->name}' in ghost mode.");
    }

    public function exitOrg(Request $request)
    {
        $request->session()->forget(['acting_org_id', 'acting_as_superadmin']);

        return redirect()->route('superadmin.dashboard')
            ->with('success', 'Exited ghost mode. Back to superadmin panel.');
    }

    /**
     * The live admins table has no updated_at column.
     *
     * @param  array  $attributes
     * @return \App\Models\Admin
     */
    protected function createOrgAdmin(array $attributes)
    {
        $admin = new Admin();

        if (!Schema::hasColumn('admins', 'updated_at')) {
            $admin->timestamps = false;
        }

        $admin->fill($attributes);
        $admin->save();

        return $admin;
    }
}

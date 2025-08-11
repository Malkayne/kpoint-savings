<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ContributionPlan;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DefaultController extends Controller
{

    public function index(){
        $user = Auth::user();
        
        // Get user's contribution plans
        $plans = ContributionPlan::where('user_id', $user->id)->get();
        $activePlans = $plans->where('status', 'active')->count();
        $completedPlans = $plans->where('status', 'completed')->count();
        $totalPlans = $plans->count();
        
        // Get user's transactions
        $transactions = Transaction::where('user_id', $user->id)->get();
        $totalTransactions = $transactions->count();
        $totalCredits = $transactions->where('type', 'credit')->sum('amount');
        $totalDebits = $transactions->where('type', 'debit')->sum('amount');
        
        // Get recent transactions
        $recentTransactions = Transaction::where('user_id', $user->id)
            ->with(['rep', 'plan'])
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();
        
        // Get recent contributions
        $recentContributions = \App\Models\Contribution::whereHas('plan', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('plan')->orderBy('created_at', 'DESC')->limit(5)->get();
        
        // Calculate plan progress
        $totalPlanAmount = $plans->sum('amount');
        $totalContributed = \App\Models\Contribution::whereHas('plan', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->sum('amount');
        $planProgress = $totalPlanAmount > 0 ? ($totalContributed / $totalPlanAmount) * 100 : 0;
        
        return view('userend.dashboard', [
            'title' => 'Dashboard',
            'user' => $user,
            'activePlans' => $activePlans,
            'completedPlans' => $completedPlans,
            'totalPlans' => $totalPlans,
            'totalTransactions' => $totalTransactions,
            'totalCredits' => $totalCredits,
            'totalDebits' => $totalDebits,
            'recentTransactions' => $recentTransactions,
            'recentContributions' => $recentContributions,
            'planProgress' => $planProgress,
            'totalPlanAmount' => $totalPlanAmount,
            'totalContributed' => $totalContributed
        ]);
    }

    public function plans(){
        $user = Auth::user();
        $plans = ContributionPlan::with(['rep', 'contributions'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('userend.plans', ['title' => 'My Plans', 'plans' => $plans]);
    }

    public function planDetails(ContributionPlan $plan){
        // Security check - ensure user can only view their own plans
        if ($plan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $plan->load(['rep', 'contributions']);
        return view('userend.planDetails', ['title' => 'Plan Details', 'plan' => $plan]);
    }

    public function profile(){
        $user = Auth::user();
        return view('userend.profile', ['title' => 'Profile', 'user' => $user]);
    }

    public function editProfile(){
        $user = Auth::user();
        return view('userend.editProfile', ['title' => 'Edit Profile', 'user' => $user]);
    }

    public function updateProfile(Request $request){
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'email' => 'nullable|email|max:100|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'profession' => 'nullable|string|max:100',
            'education' => 'nullable|string|max:100',
            'address' => 'required|string',
            'dob' => 'nullable|date',
            'nok_name' => 'required|string|max:100',
            'nok_phone' => 'required|string|max:20',
            'nok_relationship' => 'required|string|max:50',
        ]);

        $user->update($request->all());

        return redirect(route('userend.profile'))->with('success', 'Your Profile has been Successfully updated');
    }

    public function wallet(){
        $user = Auth::user();
        return view('userend.wallet', ['title' => 'Wallet', 'user' => $user]);
    }

    public function transactions(){
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)
            ->with(['rep', 'plan'])
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('userend.transactions', ['title' => 'Transactions', 'transactions' => $transactions]);
    }

    public function contact(){
        return view('userend.contact', ['title' => 'Contact']);
    }

    public function documentation(){
        return view('userend.documentation', ['title' => 'Documentation']);
    }
    
      public function contactUs(){
        return view('userend.contactUs', ['title' => 'Contact']);
    }
    
    

}

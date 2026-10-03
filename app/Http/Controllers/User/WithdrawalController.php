<?php

namespace App\Http\Controllers\User;

use App\Models\Organisation;
use App\Models\Withdrawal;
use App\Models\Manualfund;
use App\Mail\NewWithdrawalRequest;
use App\Mail\NewManualFundingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;



class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::where('user_id', Auth::id())->latest()->get();
        return view('userend.withdrawal', compact('withdrawals'));
    }

         public function store(Request $request)
        {
            $request->validate([
                'amount' => [
                    'required',
                    'numeric',
                    'min:100',
                    function ($attribute, $value, $fail) {
                        $user = Auth::user();
                    if (!$user || $value > ($user->wallet->amount ?? 0)) {
                            $fail('You do not have sufficient wallet balance for this withdrawal. Your current balance is ₦' . number_format($user && $user->wallet ? $user->wallet->amount : 0, 2) . '.');
                        }
                    }
                ],
                'bank_name' => 'required|string|max:255',
                'account_number' => 'required|string|max:20',
                'account_name' => 'required|string|max:50',
                'signature' => 'required|file|mimes:jpeg,jpg,png|max:2048'
            ]);
        
            // Store in public/withdrawal_signature
            if ($request->hasFile('signature')) {
                $file = $request->file('signature');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $destination = public_path('withdrawal_signature');
        
                // Ensure folder exists
                if (!File::exists($destination)) {
                    File::makeDirectory($destination, 0755, true);
                }
        
                $file->move($destination, $filename);
                $signaturePath = 'withdrawal_signature/' . $filename;
            } else {
                $signaturePath = null;
            }
        
                        $withdrawal = Withdrawal::create([
                'user_id' => Auth::id(),
                'amount' => $request->amount,
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'account_name' => $request->account_name,
                'signature_path' => $signaturePath,
                'status' => 'pending',
            ]);

            // Send email notification to admin using Laravel Mail
            try {
                $adminEmail = $this->orgAdminEmail();
                $user = Auth::user();
                
                Mail::to($adminEmail)->send(new NewWithdrawalRequest($withdrawal, $user));
            } catch (\Exception $e) {
                // Log error but don't fail the request
                \Log::error('Failed to send withdrawal notification email: ' . $e->getMessage());
            }

            return redirect()->back()->with('success', 'Withdrawal request submitted successfully.');
        }
        
    public function page()
    {
        $manual_fund_requests = Manualfund::where('user_id', Auth::id())->latest()->get();
        return view('userend.Manualfund', compact('manual_fund_requests'));
    }

public function mfund(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:100',
        'proof_of_payment' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
    ]);

    // Handle file upload manually
    if ($request->hasFile('proof_of_payment')) {
        $file = $request->file('proof_of_payment');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $destination = public_path('manual_funding_proofs');

        // Ensure folder exists
        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        $file->move($destination, $filename);
        $proofPath = 'manual_funding_proofs/' . $filename;
    } else {
        $proofPath = null;
    }

    // Create manual funding request
    $manualFunding = Manualfund::create([
        'user_id' => Auth::id(),
        'amount' => $request->amount,
        'proof_of_payment' => $proofPath,
        'status' => 'pending',
    ]);

    // Send email notification to admin using Laravel Mail
    try {
        $adminEmail = $this->orgAdminEmail();
        $user = Auth::user();
        
        Mail::to($adminEmail)->send(new NewManualFundingRequest($manualFunding, $user));
    } catch (\Exception $e) {
        // Log error but don't fail the request
        \Log::error('Failed to send manual funding notification email: ' . $e->getMessage());
    }

    return redirect()->back()->with('success', 'Manual funding request submitted successfully.');
}

    /**
     * Current org contact email, falling back to the shared config address.
     *
     * @return string
     */
    protected function orgAdminEmail()
    {
        $fallback = config('mail.admin_email', 'kpointsavings@gmail.com');
        $orgId = current_org_id();

        if (!$orgId) {
            return $fallback;
        }

        $org = Organisation::find($orgId);

        if ($org && $org->email) {
            return $org->email;
        }

        return $fallback;
    }
}

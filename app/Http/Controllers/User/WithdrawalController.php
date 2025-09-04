<?php

namespace App\Http\Controllers\User;

use App\Models\Withdrawal;
use App\Models\Manualfund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                'amount' => 'required|numeric|min:100',
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

            // Send email notification to admin using PHP mail function
            try {
                $adminEmail = config('mail.admin_email', 'salawuhamid96@gmail.com');
                $subject = 'New Withdrawal Request - KPoint Savings';
                $message = $this->getWithdrawalEmailContent($withdrawal);
                $headers = $this->getEmailHeaders();
                
                mail($adminEmail, $subject, $message, $headers);
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

    // Send email notification to admin using PHP mail function
    try {
        $adminEmail = config('mail.admin_email', 'salawuhamid96@gmail.com');
        $subject = 'New Manual Funding Request - KPoint Savings';
        $message = $this->getManualFundingEmailContent($manualFunding);
        $headers = $this->getEmailHeaders();
        
        mail($adminEmail, $subject, $message, $headers);
    } catch (\Exception $e) {
        // Log error but don't fail the request
        \Log::error('Failed to send manual funding notification email: ' . $e->getMessage());
    }

    return redirect()->back()->with('success', 'Manual funding request submitted successfully.');
}

/**
 * Get email headers for PHP mail function
 */
private function getEmailHeaders()
{
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: KPoint Savings <noreply@kpointsavings.com>" . "\r\n";
    $headers .= "Reply-To: noreply@kpointsavings.com" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    return $headers;
}

/**
 * Generate email content for withdrawal request
 */
private function getWithdrawalEmailContent($withdrawal)
{
    $user = Auth::user();
    
    $html = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>New Withdrawal Request</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #f4f4f4; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .details { background-color: #f9f9f9; padding: 15px; margin: 15px 0; border-left: 4px solid #007cba; }
            .footer { background-color: #f4f4f4; padding: 15px; text-align: center; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>New Withdrawal Request</h2>
            </div>
            <div class='content'>
                <p>A new withdrawal request has been submitted by a user.</p>
                
                <div class='details'>
                    <h3>User Details:</h3>
                    <p><strong>Name:</strong> {$user->name}</p>
                    <p><strong>Username:</strong> {$user->username}</p>
                    <p><strong>Email:</strong> {$user->email}</p>
                    <p><strong>Account Number:</strong> {$user->accNum}</p>
                </div>
                
                <div class='details'>
                    <h3>Withdrawal Details:</h3>
                    <p><strong>Amount:</strong> ₦" . number_format($withdrawal->amount, 2) . "</p>
                    <p><strong>Bank Name:</strong> {$withdrawal->bank_name}</p>
                    <p><strong>Account Number:</strong> {$withdrawal->account_number}</p>
                    <p><strong>Account Name:</strong> {$withdrawal->account_name}</p>
                    <p><strong>Request Date:</strong> {$withdrawal->created_at->format('Y-m-d H:i:s')}</p>
                    <p><strong>Status:</strong> {$withdrawal->status}</p>
                </div>
                
                <p>Please review this request in the admin panel.</p>
            </div>
            <div class='footer'>
                <p>This is an automated message from KPoint Savings System.</p>
            </div>
        </div>
    </body>
    </html>";
    
    return $html;
}

/**
 * Generate email content for manual funding request
 */
private function getManualFundingEmailContent($manualFunding)
{
    $user = Auth::user();
    
    $html = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>New Manual Funding Request</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #f4f4f4; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .details { background-color: #f9f9f9; padding: 15px; margin: 15px 0; border-left: 4px solid #28a745; }
            .footer { background-color: #f4f4f4; padding: 15px; text-align: center; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>New Manual Funding Request</h2>
            </div>
            <div class='content'>
                <p>A new manual funding request has been submitted by a user.</p>
                
                <div class='details'>
                    <h3>User Details:</h3>
                    <p><strong>Name:</strong> {$user->name}</p>
                    <p><strong>Username:</strong> {$user->username}</p>
                    <p><strong>Email:</strong> {$user->email}</p>
                    <p><strong>Account Number:</strong> {$user->accNum}</p>
                </div>
                
                <div class='details'>
                    <h3>Funding Details:</h3>
                    <p><strong>Amount:</strong> ₦" . number_format($manualFunding->amount, 2) . "</p>
                    <p><strong>Request Date:</strong> {$manualFunding->created_at->format('Y-m-d H:i:s')}</p>
                    <p><strong>Status:</strong> {$manualFunding->status}</p>
                    <p><strong>Proof of Payment:</strong> {$manualFunding->proof_of_payment}</p>
                </div>
                
                <p>Please review this request and the proof of payment in the admin panel.</p>
            </div>
            <div class='footer'>
                <p>This is an automated message from KPoint Savings System.</p>
            </div>
        </div>
    </body>
    </html>";
    
    return $html;
}
        
}

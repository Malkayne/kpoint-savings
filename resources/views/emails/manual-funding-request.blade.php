<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Manual Funding Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #28a745;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .info-box {
            background-color: white;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #28a745;
            border-radius: 3px;
        }
        .amount {
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            color: #666;
            font-size: 12px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>New Manual Funding Request</h1>
        <p>K-Point Savings Platform</p>
    </div>
    
    <div class="content">
        <p>Hello Admin,</p>
        
        <p>A new manual funding request has been submitted and requires your attention.</p>
        
        <div class="info-box">
            <h3>User Details:</h3>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Username:</strong> {{ $user->username ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $user->email ?? 'N/A' }}</p>
            <p><strong>Account Number:</strong> {{ $user->accNum ?? 'N/A' }}</p>
        </div>
        
        <div class="info-box">
            <h3>Funding Details:</h3>
            <p><strong>Amount:</strong> <span class="amount">₦{{ number_format($manualFunding->amount, 2) }}</span></p>
            <p><strong>Request Date:</strong> {{ $manualFunding->created_at->format('d M Y, H:i A') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($manualFunding->status) }}</p>
            @if($manualFunding->proof_of_payment)
            <p><strong>Proof of Payment:</strong> <a href="{{ asset($manualFunding->proof_of_payment) }}" target="_blank">View Document</a></p>
            @endif
        </div>
        
        <p>Please review this request in the admin dashboard and take appropriate action.</p>
        
        <div style="text-align: center;">
            <a href="{{ url('/admin/manualfunding') }}" class="btn">View in Admin Dashboard</a>
        </div>
        
        <p><strong>Note:</strong> This is an automated notification. Please do not reply to this email.</p>
    </div>
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} K-Point Savings. All rights reserved.</p>
        <p>This email was sent automatically from the K-Point Savings platform.</p>
    </div>
</body>
</html>

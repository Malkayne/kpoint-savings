<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Withdrawal Request</title>
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
            background-color: #007bff;
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
            border-left: 4px solid #007bff;
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
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>New Withdrawal Request</h1>
        <p>K-Point Savings Platform</p>
    </div>
    
    <div class="content">
        <p>Hello Admin,</p>
        
        <p>A new withdrawal request has been submitted and requires your attention.</p>
        
        <div class="info-box">
            <h3>User Details:</h3>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Username:</strong> {{ $user->username ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $user->email ?? 'N/A' }}</p>
            <p><strong>Account Number:</strong> {{ $user->accNum ?? 'N/A' }}</p>
        </div>
        
        <div class="info-box">
            <h3>Withdrawal Details:</h3>
            <p><strong>Amount:</strong> <span class="amount">₦{{ number_format($withdrawal->amount, 2) }}</span></p>
            <p><strong>Bank Name:</strong> {{ $withdrawal->bank_name }}</p>
            <p><strong>Account Number:</strong> {{ $withdrawal->account_number }}</p>
            <p><strong>Account Name:</strong> {{ $withdrawal->account_name }}</p>
            <p><strong>Request Date:</strong> {{ $withdrawal->created_at->format('d M Y, H:i A') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($withdrawal->status) }}</p>
        </div>
        
        <p>Please review this request in the admin dashboard and take appropriate action.</p>
        
        <div style="text-align: center;">
            <a href="{{ url('/admin/withdrawal') }}" class="btn">View in Admin Dashboard</a>
        </div>
        
        <p><strong>Note:</strong> This is an automated notification. Please do not reply to this email.</p>
    </div>
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} K-Point Savings. All rights reserved.</p>
        <p>This email was sent automatically from the K-Point Savings platform.</p>
    </div>
</body>
</html>

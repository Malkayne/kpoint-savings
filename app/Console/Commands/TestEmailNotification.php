<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewWithdrawalRequest;
use App\Mail\NewManualFundingRequest;
use App\Models\Withdrawal;
use App\Models\Manualfund;
use App\Models\User;

class TestEmailNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email-notification {type} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email notifications for withdrawal and manual funding requests';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $type = $this->argument('type');
        $email = $this->argument('email');

        if (!in_array($type, ['withdrawal', 'manual-funding'])) {
            $this->error('Type must be either "withdrawal" or "manual-funding"');
            return 1;
        }

        try {
            if ($type === 'withdrawal') {
                // Create a test withdrawal request
                $user = User::first();
                if (!$user) {
                    $this->error('No users found in database. Please create a user first.');
                    return 1;
                }

                $withdrawal = new Withdrawal([
                    'user_id' => $user->id,
                    'amount' => 50000.00,
                    'bank_name' => 'Test Bank',
                    'account_number' => '1234567890',
                    'account_name' => 'Test Account',
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                $withdrawal->setRelation('user', $user);

                Mail::to($email)->send(new NewWithdrawalRequest($withdrawal));
                $this->info('Withdrawal notification email sent successfully to ' . $email);
            } else {
                // Create a test manual funding request
                $user = User::first();
                if (!$user) {
                    $this->error('No users found in database. Please create a user first.');
                    return 1;
                }

                $manualFunding = new Manualfund([
                    'user_id' => $user->id,
                    'amount' => 25000.00,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                $manualFunding->setRelation('user', $user);

                Mail::to($email)->send(new NewManualFundingRequest($manualFunding));
                $this->info('Manual funding notification email sent successfully to ' . $email);
            }

            return 0;
        } catch (\Exception $e) {
            $this->error('Failed to send email: ' . $e->getMessage());
            return 1;
        }
    }
}
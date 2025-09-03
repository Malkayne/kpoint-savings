<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class TestMailConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:mail-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test mail configuration and display current settings';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Current Mail Configuration:');
        $this->line('========================');
        
        $this->line('MAIL_MAILER: ' . config('mail.default'));
        $this->line('MAIL_HOST: ' . config('mail.mailers.smtp.host'));
        $this->line('MAIL_PORT: ' . config('mail.mailers.smtp.port'));
        $this->line('MAIL_USERNAME: ' . config('mail.mailers.smtp.username'));
        $this->line('MAIL_ENCRYPTION: ' . config('mail.mailers.smtp.encryption'));
        $this->line('MAIL_FROM_ADDRESS: ' . config('mail.from.address'));
        $this->line('MAIL_FROM_NAME: ' . config('mail.from.name'));
        $this->line('MAIL_ADMIN_EMAIL: ' . config('mail.admin_email'));
        
        $this->line('');
        $this->info('Environment Variables:');
        $this->line('=====================');
        $this->line('MAIL_MAILER: ' . env('MAIL_MAILER', 'not set'));
        $this->line('MAIL_HOST: ' . env('MAIL_HOST', 'not set'));
        $this->line('MAIL_PORT: ' . env('MAIL_PORT', 'not set'));
        $this->line('MAIL_USERNAME: ' . env('MAIL_USERNAME', 'not set'));
        $this->line('MAIL_PASSWORD: ' . (env('MAIL_PASSWORD') ? '***set***' : 'not set'));
        $this->line('MAIL_ENCRYPTION: ' . env('MAIL_ENCRYPTION', 'not set'));
        $this->line('MAIL_FROM_ADDRESS: ' . env('MAIL_FROM_ADDRESS', 'not set'));
        $this->line('MAIL_FROM_NAME: ' . env('MAIL_FROM_NAME', 'not set'));
        $this->line('MAIL_ADMIN_EMAIL: ' . env('MAIL_ADMIN_EMAIL', 'not set'));
        
        return 0;
    }
}
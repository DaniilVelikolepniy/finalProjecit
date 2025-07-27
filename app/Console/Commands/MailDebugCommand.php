<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class MailDebugCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:debug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Debug mail configuration and test connection';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Mail Configuration Debug');
        $this->line('');

        // Display current mail configuration
        $this->info('📧 Current Mail Configuration:');
        $this->line('Driver: ' . Config::get('mail.default'));
        $this->line('From Address: ' . Config::get('mail.from.address'));
        $this->line('From Name: ' . Config::get('mail.from.name'));
        
        $driver = Config::get('mail.default');
        $this->line('');
        $this->info("📋 {$driver} Configuration:");
        
        switch ($driver) {
            case 'smtp':
                $this->displaySmtpConfig();
                break;
            case 'mailgun':
                $this->displayMailgunConfig();
                break;
            case 'log':
                $this->displayLogConfig();
                break;
            default:
                $this->line("Driver '{$driver}' configuration not displayed");
        }
        
        $this->line('');
        $this->info('🧪 Test Options:');
        $this->line('1. Run: php artisan mail:test your@email.com');
        $this->line('2. Check logs in storage/logs/laravel.log');
        $this->line('3. For SMTP: Check your mail server logs');
    }
    
    private function displaySmtpConfig()
    {
        $this->line('Host: ' . Config::get('mail.mailers.smtp.host'));
        $this->line('Port: ' . Config::get('mail.mailers.smtp.port'));
        $this->line('Encryption: ' . Config::get('mail.mailers.smtp.encryption'));
        $this->line('Username: ' . Config::get('mail.mailers.smtp.username'));
        $this->line('Password: ' . (Config::get('mail.mailers.smtp.password') ? '***SET***' : '***NOT SET***'));
    }
    
    private function displayMailgunConfig()
    {
        $this->line('Domain: ' . Config::get('services.mailgun.domain'));
        $this->line('Secret: ' . (Config::get('services.mailgun.secret') ? '***SET***' : '***NOT SET***'));
    }
    
    private function displayLogConfig()
    {
        $this->line('Log Channel: ' . Config::get('mail.mailers.log.channel'));
        $this->line('Log Path: storage/logs/laravel.log');
    }
} 
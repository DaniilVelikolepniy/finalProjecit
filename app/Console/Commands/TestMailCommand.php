<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\TestMail;

class TestMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test {email? : Email address to send test mail to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email sending functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        if (!$email) {
            $email = $this->ask('Please enter the email address to send test mail to:');
        }

        $validator = Validator::make(['email' => $email], [
            'email' => ['required', 'email']
        ]);
        if ($validator->fails()) {
            $this->error('Invalid email address provided.');
            return 1;
        }

        try {
            $this->info('Sending test email to: ' . $email);
            
            Mail::to($email)->send(new TestMail());
            
            $this->info('Test email sent successfully!');
            $this->info('Check your email inbox and spam folder.');
            
            return 0;
        } catch (\Exception $e) {
            $this->error('Failed to send test email: ' . $e->getMessage());
            $this->error('Please check your mail configuration in .env file.');
            
            return 1;
        }
    }
} 
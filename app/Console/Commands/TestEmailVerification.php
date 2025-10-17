<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserRegistration;
use App\Http\Controllers\Auth\UserRegistrationController;
use Illuminate\Support\Facades\Mail;

class TestEmailVerification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email-verification {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email verification sending';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        // Create a test registration
        $registration = UserRegistration::create([
            'name' => 'Test User',
            'email' => $email,
            'phone' => '081234567890',
            'institution' => 'Test Institution',
            'department' => 'Test Department',
            'reason_for_registration' => 'Testing email verification',
            'verification_token' => UserRegistration::generateVerificationToken(),
        ]);
        
        $this->info('Created test registration with ID: ' . $registration->id);
        
        // Send verification email
        $verificationUrl = route('email.verify', ['token' => $registration->verification_token]);
        
        try {
            Mail::send('emails.verify-registration', [
                'registration' => $registration,
                'verificationUrl' => $verificationUrl
            ], function ($message) use ($registration) {
                $message->to($registration->email, $registration->name)
                    ->subject('Verifikasi Email - Komite Etik UNAND');
            });
            
            $this->info('Email verification sent successfully to: ' . $email);
            $this->info('Verification URL: ' . $verificationUrl);
            
        } catch (\Exception $e) {
            $this->error('Failed to send email: ' . $e->getMessage());
        }
        
        // Clean up test data
        $registration->delete();
        $this->info('Test registration cleaned up.');
    }
}

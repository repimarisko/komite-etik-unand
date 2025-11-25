<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserRegistration;
use App\Models\User;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRegistrationController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|unique:user_registrations',
            'phone' => 'nullable|string|max:20',
            'institution' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'reason_for_registration' => 'required|string|max:1000',
        ]);

        $registration = UserRegistration::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'department' => $request->department,
            'reason_for_registration' => $request->reason_for_registration,
            'verification_token' => UserRegistration::generateVerificationToken(),
            'email_verified_at' => now(),
        ]);

        return redirect()->route('registration.success')
            ->with('success', 'Registrasi berhasil! Data Anda sedang menunggu verifikasi operator dan super admin.');
    }

    /**
     * Show registration success page.
     */
    public function registrationSuccess()
    {
        return view('auth.registration-success');
    }

    /**
     * Verify email address.
     */
    public function verifyEmail(Request $request, $token)
    {
        return redirect()->route('login')
            ->with('info', 'Verifikasi email tidak diperlukan. Akun Anda menunggu verifikasi operator dan super admin.');
    }

    /**
     * Verify email by token (alternative route).
     */
    public function verifyEmailByToken($token)
    {
        return redirect()->route('login')
            ->with('info', 'Verifikasi email tidak diperlukan. Silakan tunggu verifikasi operator dan super admin.');
    }

    /**
     * Show verification success page.
     */
    public function verificationSuccess()
    {
        return redirect()->route('registration.success');
    }

    /**
     * Show verification notice page.
     */
    public function showVerificationNotice()
    {
        return view('auth.verify-email');
    }

    /**
     * Resend verification email.
     */
    public function resendVerification(Request $request)
    {
        return back()->with('status', 'Verifikasi email tidak diperlukan. Kami akan menghubungi Anda setelah proses verifikasi selesai.');
    }

    /**
     * Send credentials email after approval.
     */
    public static function sendCredentialsEmail(UserRegistration $registration)
    {
        if (!$registration->generated_username || !$registration->generated_password) {
            return false;
        }

        Mail::send('emails.user-credentials', [
            'registration' => $registration,
            'username' => $registration->generated_username,
            'password' => $registration->generated_password,
            'loginUrl' => route('login')
        ], function ($message) use ($registration) {
            $message->to($registration->email, $registration->name)
                ->subject('Akun Anda Telah Disetujui - Komite Etik UNAND');
        });

        $registration->update([
            'credentials_sent' => true,
            'credentials_sent_at' => now()
        ]);

        return true;
    }

    /**
     * Create user from approved registration.
     */
    public static function createUserFromRegistration(UserRegistration $registration, int $approvedBy)
    {
        if ($registration->status !== 'approved') {
            return false;
        }

        // Generate username and password
        $username = $registration->generateUsername();
        $password = UserRegistration::generatePassword();

        // Update registration with generated credentials
        $registration->update([
            'generated_username' => $username,
            'generated_password' => $password
        ]);

        // Create user
        $user = User::create([
            'name' => $registration->name,
            'email' => $registration->email,
            'username' => $username,
            'password' => Hash::make($password),
            'phone' => $registration->phone,
            'email_verified_at' => $registration->email_verified_at,
            'status' => 'active',
            'role' => 'pengusul_etik',
            'approved_at' => $registration->approved_at,
            'approved_by' => $approvedBy,
            'notes' => $registration->admin_notes
        ]);

        // Assign default role (pengusul etik)
        $user->assignRole('pengusul_etik', $approvedBy);

        // Log activity
        AdminActivityLog::logActivity(
            $approvedBy,
            'create',
            'App\\Models\\User',
            $user->id,
            null,
            $user->toArray(),
            'Membuat user dari registrasi yang disetujui',
            request()->ip(),
            request()->userAgent()
        );

        // Send credentials email
        self::sendCredentialsEmail($registration);

        return $user;
    }
}

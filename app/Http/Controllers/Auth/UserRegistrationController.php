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
use Illuminate\Validation\ValidationException;

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

        $verificationToken = UserRegistration::generateVerificationToken();

        $registration = UserRegistration::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'department' => $request->department,
            'reason_for_registration' => $request->reason_for_registration,
            'verification_token' => $verificationToken,
        ]);

        // Send verification email
        $this->sendVerificationEmail($registration);

        return redirect()->route('registration.success')
            ->with('success', 'Registrasi berhasil! Silakan cek email Anda untuk verifikasi.');
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
        $registration = UserRegistration::where('verification_token', $token)
            ->whereNull('email_verified_at')
            ->first();

        if (!$registration) {
            return redirect()->route('login')
                ->with('error', 'Token verifikasi tidak valid atau sudah digunakan.');
        }

        $registration->update([
            'email_verified_at' => now(),
        ]);

        return redirect()->route('email.verified')
            ->with('success', 'Email berhasil diverifikasi! Registrasi Anda sedang menunggu persetujuan admin.');
    }

    /**
     * Verify email by token (alternative route).
     */
    public function verifyEmailByToken($token)
    {
        $registration = UserRegistration::where('verification_token', $token)
            ->whereNull('email_verified_at')
            ->first();

        if (!$registration) {
            return redirect()->route('login')
                ->with('error', 'Token verifikasi tidak valid atau sudah digunakan.');
        }

        $registration->update([
            'email_verified_at' => now(),
        ]);

        return redirect()->route('email.verified')
            ->with('success', 'Email berhasil diverifikasi! Registrasi Anda sedang menunggu persetujuan admin.');
    }

    /**
     * Show verification success page.
     */
    public function verificationSuccess()
    {
        return view('auth.verification-success');
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
        $request->validate([
            'email' => 'required|email'
        ]);

        $registration = UserRegistration::where('email', $request->email)
            ->whereNull('email_verified_at')
            ->where('status', 'pending')
            ->first();

        if (!$registration) {
            throw ValidationException::withMessages([
                'email' => 'Email tidak ditemukan atau sudah diverifikasi.'
            ]);
        }

        // Generate new token
        $registration->update([
            'verification_token' => UserRegistration::generateVerificationToken()
        ]);

        $this->sendVerificationEmail($registration);

        return back()->with('success', 'Email verifikasi telah dikirim ulang.');
    }

    /**
     * Send verification email.
     */
    private function sendVerificationEmail(UserRegistration $registration)
    {
        $verificationUrl = route('email.verify', ['token' => $registration->verification_token]);

        Mail::send('emails.verify-registration', [
            'registration' => $registration,
            'verificationUrl' => $verificationUrl
        ], function ($message) use ($registration) {
            $message->to($registration->email, $registration->name)
                ->subject('Verifikasi Email - Komite Etik UNAND');
        });
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
            'status' => true,
            'approved_at' => $registration->approved_at,
            'approved_by' => $approvedBy,
            'notes' => $registration->admin_notes
        ]);

        // Assign default role (user)
        $user->assignRole('user', $approvedBy);

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
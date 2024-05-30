<?php

namespace App\Http\Controllers;

use App\Jobs\SendVerificationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => null,
            'verification_token' => Str::random(60),
            'token_expires_at' => Carbon::now()->addMinutes(5),
        ]);

        // Dispatch verification email job
        SendVerificationEmail::dispatch($user);
        return redirect('/')->with('success', 'Registration successful! Please check your email to verify your account.');
    }

    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->firstOrFail();

        if (Carbon::now()->gt($user->token_expires_at)) {
            return redirect('/')->with('error', 'Verification link expired.');
        }

        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->token_expires_at = null;
        $user->save();

        return redirect('/')->with('success', 'Email verified successfully!');
    }
}

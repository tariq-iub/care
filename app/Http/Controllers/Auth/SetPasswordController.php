<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetPasswordController extends Controller
{
    /**
     * Show the form for setting the password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showSetPasswordForm(Request $request)
    {
        // Fetch the user ID from the query parameter
        $userId = $request->query('id');

        // Return the view with the user ID
        return view('auth.passwords.set', ['userId' => $userId]);
    }

    /**
     * Set the password for the user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setPassword(Request $request)
    {
        $request->validate([
            'userId' => 'required|integer',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $userId = $request->input('userId');
        $password = $request->input('password');

        // Find the user registration record
        $user = User::findOrFail($userId);

        // Find the user registration record by email
        $userRegistration = UserRegistration::where('email', $user->email)->first();

        // Check if the user registration record exists
        if ($userRegistration) {
            // Set the user registered status to 1
            $userRegistration->client_registered = 1;
            $userRegistration->save();
        }

        if (!$user) {
            return redirect('/')->with('error', 'User not found.');
        }

        // Update the user with the new password
        $user->password = bcrypt($password);
        $user->save();

        Auth::logout();        // Log out the user and invalidate the session
        $request->session()->invalidate();        // Invalidate the session
        $request->session()->regenerateToken();        // Regenerate the session token to prevent session fixation attacks

        // Redirect to login page
        return redirect()->route('login')->with('status', 'Password set successfully. Please log in.');
    }
}

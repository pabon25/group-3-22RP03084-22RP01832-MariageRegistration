<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $user = Auth::user();

        // Get application counts
        $totalApplications = $user->applications()->count();
        $approvedApplications = $user->applications()->where('status', 'approved')->count();
        $pendingApplications = $user->applications()->where('status', 'pending')->count();

        // Get recent applications
        $recentApplications = $user->applications()->latest()->take(5)->get();

        return view('user.dashboard', compact(
            'user',
            'totalApplications',
            'approvedApplications',
            'pendingApplications',
            'recentApplications'
        ));
    }

    /**
     * Show the user profile.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Update the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|max:20',
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'address' => 'required|string|max:500',
        ];

        // Only validate password if it's being changed
        if ($request->filled('password')) {
            $rules['current_password'] = 'required|string';
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $validated = $request->validate($rules);

        // Check if current password is correct when changing password
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
            }
        }

        // Update user information
        $user->full_name = $validated['full_name'];
        $user->email = $validated['email'];
        $user->phone_number = $validated['phone_number'];
        $user->dob = $validated['dob'];
        $user->gender = $validated['gender'];
        $user->address = $validated['address'];

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\UserRegistration;
use Illuminate\Http\Request;

class UserRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userRegistrations = UserRegistration::all();

        return view('admin.user_registration.index', compact('userRegistrations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserRegistration $userRegistration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserRegistration $userRegistration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserRegistration $userRegistration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserRegistration $userRegistration)
    {
        //
    }

    public function updateResponderId(Request $request)
    {
        $userId = $request->input('user_id');

        // Validate inputs
        $request->validate([
            'user_id' => 'required|integer|exists:user_registrations,id',
        ]);

        // Find the user registration record and update the responder_id
        $userRegistration = UserRegistration::findOrFail($userId);
        $userRegistration->responder_id = auth()->id();
        $userRegistration->save();

        return response()->json(['message' => 'Responder ID updated successfully.']);
    }

    public function updateRemarks(Request $request)
    {
        $userId = $request->input('user_id');
        $remarks = $request->input('remarks');

        // Validate inputs
        $request->validate([
            'user_id' => 'required|integer|exists:user_registrations,id',
            'remarks' => 'required|string',
        ]);

        // Find the user registration record and update the remarks
        $userRegistration = UserRegistration::findOrFail($userId);
        $userRegistration->remarks = $remarks;
        $userRegistration->save();

        return response()->json(['message' => 'Remarks updated successfully.']);
    }

    public function createClient(Request $request)
    {
        // Validate user_id
        $request->validate([
            'user_id' => 'required|integer|exists:user_registrations,id',
        ]);

        // Validate user fields
        $userData = $request->only(['username', 'email']);
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            // Add other fields validation as necessary
        ]);

        // Modify userData to replace 'username' with 'name'
        if (isset($userData['username'])) {
            $userData['name'] = $userData['username'];
            unset($userData['username']);
        }

        // Add password to user data and hash it
        $userData['status'] = 0;
        $userData['role_id'] = 3;
        $userData['password'] = bcrypt("password"); // Use a default or generate a random password

        // Create the user
        $user = User::create($userData);

        // Find the user registration record and update the user_created_at
        $userRegistration = UserRegistration::findOrFail($request->input('user_id'));
        $userRegistration->user_created_at = now();
        $userRegistration->save();

        return response()->json(['message' => 'User created successfully.']);
    }

    public function createCompany(Request $request)
    {
        $userId = $request->input('user_id');

        $companyData = $request->only([
            'company_name', 'company_address', 'company_city',
            'company_state', 'company_zip', 'company_country',
            'email', 'phone', 'contact_name', 'contact_title'
        ]);

        // Validate inputs
        $request->validate([
            'user_id' => 'required|integer|exists:user_registrations,id',
            'company_name' => 'required|string',
            'company_address' => 'required|string',
            'company_city' => 'required|string',
            'company_state' => 'required|string',
            'company_zip' => 'required|string',
            'company_country' => 'required|string',
            'email' => 'required|email|exists:users,email',
            'phone' => 'required|string',
            'contact_name' => 'required|string',
            'contact_title' => 'required|string',
        ]);

        // Create the company
        $company = Company::create([
            'company_name' => $companyData['company_name'],
            'address' => $companyData['company_address'],
            'city' => $companyData['company_city'],
            'state' => $companyData['company_state'],
            'zip' => $companyData['company_zip'],
            'country' => $companyData['company_country'],
            'contact_name' => $companyData['contact_name'],
            'contact_title' => $companyData['contact_title'],
            'phone_number' => $companyData['phone'],
            'email' => $companyData['email'],
        ]);

        // Find the user registration record and update the company_registered_at
        $userRegistration = UserRegistration::findOrFail($userId);
        $userRegistration->company_registration_date = now();
        $userRegistration->save();

        return response()->json(['message' => 'Company created successfully.']);
    }

    public function emailClient(Request $request)
    {
        $userId = $request->input('user_id');

        // Validate inputs
        $request->validate([
            'user_id' => 'required|integer|exists:user_registrations,id',
        ]);

        // Find the user registration record
        $userRegistration = UserRegistration::findOrFail($userId);

        // Find the corresponding user in the users table
        $user = User::where('email', $userRegistration->email)->firstOrFail();

        $user->sendEmailVerificationNotification();

        // Update client_emailed_at
        $userRegistration->client_emailed = now();
        $userRegistration->save();

        return response()->json(['message' => 'Email sent and timestamp updated successfully.']);
    }
}

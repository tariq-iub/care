<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Note;
use App\Models\Plant;
use App\Models\PlantServiceRep;
use App\Models\Role;
use App\Models\ServiceRepresentative;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        $serviceReps = ServiceRepresentative::all();

        return view('admin.plants.index', compact('companies', 'serviceReps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $serviceReps = ServiceRepresentative::all();

        return view('admin.plants.create', compact('serviceReps'));
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
    public function show(Company $company)
    {
        $plant = Plant::where('company_id', $company->id)->first();
        $note = Note::where('id', $plant->note_id)->first();
        $plantServiceRep = PlantServiceRep::where('plant_id', $plant->id)->first();
        $serviceRepresentative = ServiceRepresentative::where('id', $plantServiceRep->service_rep_id)->first();

        return view('admin.plants.show', compact(
            'company', 'plant', 'note', 'serviceRepresentative'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {

        return view('admin.plants.edit', compact(
            'company',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }

    public function saveCompanyInfo(Request $request)
    {
        // Validate the request
        $validator = $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_title' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'alt_phone_number' => 'nullable|string|max:15',
            'fax_number' => 'nullable|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        // Save the company information
        $company = Company::updateOrCreate(
            ['id' => $request->input('company_id'),
                'company_name' => $validator['company_name'],
                'address' => $validator['address'],
                'city' => $validator['city'],
                'state' => $validator['state'],
                'zip' => $validator['zip'],
                'country' => $validator['country'],
                'contact_name' => $validator['contact_name'],
                'contact_title' => $validator['contact_title'],
                'phone_number' => $validator['phone_number'],
                'alt_phone_number' => $validator['alt_phone_number'],
                'fax_number' => $validator['fax_number'],
                'email' => $validator['email'],
            ],
        );

        return response()->json(['success' => true, 'company' => $company]);
    }

    public function updateCompanyInfo(Request $request)
    {
        $validator = $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_title' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'alt_phone_number' => 'nullable|string|max:15',
            'fax_number' => 'nullable|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        $company = Company::where('id', $request->input('company_id'))->firstOrFail();

        $company->update($request->all());

        return response()->json(['success' => true, 'company' => $company]);
    }

    function fetchCompanies(Request $request, $id)
    {
        $company = Company::where('id', $id)->first()->toArray();

        return response()->json(['company' => $company]);
    }

    function manageUsersIndex($id)
    {
        $users = User::join('company_users', 'users.id', '=', 'company_users.user_id')
            ->where('company_users.company_id', $id)
            ->get();

        return view('admin.plants.manage-users', compact('users', 'id'));
    }

    function storeUser(Request $request)
    {
        $photoPath = null;
        if ($request->hasFile('photo_path')) {
            $file = $request->file('photo_path');
            $filename = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $photoPath = $file->storeAs('users', $filename, 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $photoPath,
            'status' => $request->status,
        ]);

        $companyUser = CompanyUser::create([
            'company_id' => $request->company_id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('company.manage_users', $request->company_id)->with('message', 'User created successfully.');
    }

    function updateUser(Request $request)
    {
        $companyUser = CompanyUser::where('user_id', $request->user_id)->first();

        $companyUser->update([
            'access_level' => $request->access_level,
        ]);

        $user = User::where('id', $request->user_id)->first();

        if ($request->hasFile('photo_path')) {
            $file = $request->file('photo_path');
            $filename = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $photoPath = $file->storeAs('users', $filename, 'public');
            $user->update([
                'avatar' => $photoPath,
            ]);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['success' => true]);
    }

    public function statusToggle(User $user, Request $request)
    {
        if ($user->status) {
            $user->status = false;
        } else {
            $user->status = true;
        }
        $user->save();

        return redirect()->route('company.manage_users', $request->company_id);
    }

    public function fetchUser(Request $request, $userId)
    {
        $user = User::join('company_users', 'users.id', '=', 'company_users.user_id')
            ->where('company_users.user_id', $userId)
            ->first()->toArray();

        return response()->json(['user' => $user]);
    }

    public function fetch(Request $request)
    {
        $companies = Company::all();
        return response()->json(['companies' => $companies]);
    }
}

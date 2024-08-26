<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserRegistration;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user_registered';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user_registrations'],
            'phone' => ['required', 'string', 'max:15'],
            'company_name' => ['required', 'string', 'max:255'],
            'company_address' => ['required', 'string', 'max:255'],
            'company_city' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\UserRegistration
     */
    protected function create(array $data)
    {
        return UserRegistration::create([
            'username' => $data['username'], // Assuming 'username' maps to 'name'
            'email' => $data['email'],
            'phone_no' => $data['phone'], // Ensure this is the correct field name
            'company_name' => $data['company_name'],
            'company_address' => $data['company_address'],
            'company_city' => $data['company_city'],
        ]);
    }

    protected function redirectPath()
    {
        return '/user_registered';
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $this->create($request->all());

        return redirect($this->redirectPath());
    }
}

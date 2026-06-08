<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
public function store(Request $request): RedirectResponse
{
    $request->validate(
        [
            'name' => ['required', 'string', 'min:3', 'max:50'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/'
            ],
        ],
        [
            // NAME
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters long',

            // EMAIL
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email format (example@gmail.com)',
            'email.unique' => 'This email is already registered',
            'email.regex' => 'Email must be a valid Gmail address (example@gmail.com)',

            // PASSWORD
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',

            'password.regex' => 'Password must include:
            - At least one uppercase letter
            - At least one lowercase letter
            - At least one number
            - At least one special character (@$!%*?&)',

            'password.confirmed' => 'Password confirmation does not match',
        ]
    );

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('dashboard', absolute: false));
}
}

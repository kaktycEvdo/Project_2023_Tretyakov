<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:51'],
            'surname' => ['required', 'string', 'max:51'],
            'patronymic' => ['string', 'max:51'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:70', 'unique:'.PersonalData::class],
            'password' => ['required', 'confirmed'],
            //, Rules\Password::defaults()
            'phone' => ['required'],
            'login'=> ['required', 'unique:'.User::class],
        ]);
        
        PersonalData::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
            'email' => $request->email,
            'phone' => $request->phone,
            'login' => $request->login,
        ]);

        $user = User::create([
            'email' => $request->email,
            'login' => $request->login,
            'password' => Hash::make($request->password),
        ]);
        
        event(new Registered($user));

        Auth::login($user, remember: $request->remember);

        return redirect(route('index', absolute: true));
    }
}

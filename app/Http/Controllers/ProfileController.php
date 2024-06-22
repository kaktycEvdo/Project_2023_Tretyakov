<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Freelancer;
use App\Models\PersonalData;
use App\Models\Purchaser;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    
    public function edit(Request $request): View
    {
        $id = $request->id ? $request->id : Auth::user()->id;
        $email = User::where('id', $id)->first()->email;
        $profile = PersonalData::where('email', $email)->first();
        $fr_profile = Freelancer::where('email', $email)->first();
        $pr_profile = Purchaser::where('email', $email)->first();
        if(!$fr_profile || !$pr_profile){
            $fr_profile = Freelancer::create([
                'email' => $email,
                'about' => 'Я только что создал аккаунт!'
            ]);
    
            $pr_profile = Purchaser::create([
                'email' => $email,
                'about' => 'Я только что создал аккаунт!'
            ]);
        }
        $user = [
            'id' => $id,
            'name' => $profile->name,
            'surname' => $profile->surname,
            'patronymic' => $profile->patronymic,
            'email' => $email,
            'fr-about' => $fr_profile->about,
            'fr-chars' => explode(', ', $fr_profile->characteristics),
            'pr-about' => $pr_profile->about,
            'pr-chars' => explode(', ', $pr_profile->characteristics),
        ];
        
        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $fr_changes = [$request->fr_about, $request->fr_characteristics];
        $pr_changes = [$request->pr_about, $request->pr_characteristics];
        $request->user()->fill($request->validated());

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

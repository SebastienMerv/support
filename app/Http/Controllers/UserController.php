<?php

namespace App\Http\Controllers;

use App\Jobs\ActivateAccount;
use App\Mail\ActivateAccount as MailActivateAccount;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        $groups = Group::all();

        return view(
            'users.create',
            [
                'groups' => $groups
            ]
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:8|nullable',
            'group_id' => 'required|exists:groups,id',
            [
                'name.required' => 'Le champ nom est obligatoire !',
                'email.required' => 'Le champ email est obligatoire !',
                'email.email' => 'Le champ email doit être une adresse email valide !',
                'password.required' => 'Le champ mot de passe est obligatoire !',
                'password.min' => 'Le champ mot de passe doit contenir au moins 8 caractères !',
                'group_id.required' => 'Le champ groupe est obligatoire !',
                'group_id.exists' => 'Le groupe sélectionné n\'existe pas !',
                'email.unique' => 'Cet email est déjà utilisé !'
            ]
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->group_id = $validated['group_id'];
        $user->password = bcrypt($validated['password']);
        $user->save();

        if($request->link == "on") {
            // TODO : Send à link to the user to activate account
            Mail::to($user->email)->queue(new MailActivateAccount($user));
        }

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès !');
    }

    public function forgotPassword() {
        return view('auth.forgot-password');
    }

    public function sendForgotPassword(Request $request) {
        $user = User::where('email', $request->email)->first();

        if($user) {
            App::setLocale('fr');
            Password::sendResetLink(['email' => $user->email]);
        }

        return redirect()->route('forgot-password')->with('success', 'Un email vous a été envoyé pour réinitialiser votre mot de passe !');
    }

    public function resetPassword($token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function token($token) {
        return view('auth.token', ['token' => $token]);
    }

    public function proccessToken(Request $request, $token) {
        // Validate the request
        $request->validate([
            'password' => 'required|min:8',
        ]);

        // Find the user with the token
        $user = User::where('remember_token', $token)->first();
        if($user) {
            $user->password = bcrypt($request->password);
            $user->remember_token = null;
            $user->save();

            return redirect()->route('login')->with('success', 'Votre mot de passe a été réinitialisé avec succès !');
        }

        return redirect()->route('token', ['token' => $token])->with('error', 'Le token est invalide !');
    }
}

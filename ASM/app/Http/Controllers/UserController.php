<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Commande;// Importer la classe User
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class UserController extends Controller
{
      // Autres méthodes du contrôleur

    /**
     * Affiche le formulaire de réinitialisation du mot de passe.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    



    // Méthode pour afficher tous les utilisateurs
    public function index()
    {
        $users = User::all(['nom', 'prenom', 'periode', 'nombreCommandesTerminees']);
        return response()->json($users);
    }
    

    // Méthode pour afficher un utilisateur spécifique
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Méthode pour créer un nouvel utilisateur
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'tel' => 'nullable|string',
            'specialite' => 'required|string',
            'localisation' => 'required|string',
        ]);
    
        $user = User::create($validatedData);
    
        return response()->json($user, 201);
    }
    

    // Méthode pour mettre à jour un utilisateur existant
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'tel' => 'nullable|string',
            'specialite' => 'required|string',
            'localisation' => 'required|string',
        ]);
    
        $user->update($validatedData);
    
        return response()->json($user);
    }
    

    // Méthode pour supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    
        return response()->json(null, 204);
    }
    

    // Méthode pour enregistrer un nouvel utilisateur
    public function register(Request $request)
    {
        // Check if email already exists
        $existingUser = User::where('email', $request->input('email'))->first();
        if ($existingUser) {
            return response()->json(['message' => 'Ce compte existe déjà'], 409);
        }
    
        // Create new user
        $user = new User();
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->tel = $request->tel;
        $user->specialite = $request->specialite;
        $user->localisation = $request->localisation;
    
        $user->save();
    
        return response()->json(['message' => 'User registered successfully'], 201);
    }
    
   
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:255',
            'password' => 'required'
        ]);
    
        $loginCredentials = $request->only('email', 'password');
    
        if (!Auth::attempt($loginCredentials)) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }
    
        /** @var User $user */
        $user = Auth::user();
    
        $token = $user->createToken($user->nom);
    
        return response()->json([
            'id' => $user->id,
            'nom' => $user->nom,
            'role' => $user->specialite,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'token' => $token,
        ], 200);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Déconnexion réussie'], 200);
    }


    public function showResetPasswordForm(Request $request)
    {
        $email = $request->email;
        $token = $request->token;
    
        return view('auth.passwords.reset', ['email' => $email, 'token' => $token]);
    }
    //pour mot de passe oublier 
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $response = Password::sendResetLink($request->only('email'));

        return $response == Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Un lien de réinitialisation de mot de passe a été envoyé à votre adresse email.'], 200)
            : response()->json(['message' => 'Échec de l\'envoi du lien de réinitialisation de mot de passe.'], 400);
    }
   
    public function resetPassword(Request $request)
{
  $request->validate([
    'token' => 'required',
    'email' => 'required|email',
    'password' => 'required|min:8|confirmed',
  ]);

  $resetPasswordStatus = Password::reset(
    $request->only('email', 'password', 'password_confirmation', 'token'),
    function ($user, $password) {
      $user->password = Hash::make($password);
      $user->save();
    }
  );

  if ($resetPasswordStatus == Password::PASSWORD_RESET) {
    return response()->json(['message' => 'Password reset successfully'], 200);
  }

  return response()->json(['message' => 'Password reset failed'], 400);
}
public function updateAvatar(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'avatar' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    // Sauvegarde de l'image
    if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $avatarName = time().'_'.$avatar->getClientOriginalName();
        $avatar->move(public_path('avatars'), $avatarName);

        $user->avatar = $avatarName;
    }

    $user->save();

    return response()->json(['message' => 'Avatar updated successfully'], 200);
}


  
public function getUsersByPeriod()
{
    // Récupérer les utilisateurs triés par période
    $users = User::orderBy('periode', 'asc')->get();
    return response()->json($users);
}


}
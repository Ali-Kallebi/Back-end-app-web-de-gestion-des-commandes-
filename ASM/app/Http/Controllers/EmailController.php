<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommandeAffectee;
use App\Mail\MeilleurOuvrierNotification; // Assurez-vous d'importer le bon modèle de mail
use App\Models\User;
use App\Mail\CommandeTerminee;
use App\Mail\CommandeRejetee;
use App\Mail\CommandeAffecteeUser;
class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'to' => 'nullable|email',
            'description' => 'required|string',
            'date_affecte' => 'required|date',
        ]);
        
        try {
            $commande = Commande::findOrFail($request->input('commande_id'));
            $description = $request->input('description');
            $date_affecte = $request->input('date_affecte');

            $user = User::where('email', $request->input('to'))->first();
        
            if ($request->input('to')) {
                Mail::to($request->input('to'))->send(new CommandeAffecteeUser($commande, $user, $description, $date_affecte));
            }

            if ($commande->mailClient) {
                Mail::to($commande->mailClient)->send(new CommandeAffectee($commande, $user, $description, $date_affecte));
            }
        
            return response()->json(['message' => 'E-mails envoyés avec succès'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur s\'est produite lors de l\'envoi des e-mails: ' . $e->getMessage()], 500);
        }
    }

    


    //commandeterminé 
    public function sendMailTerminee(Request $request)
{
    $request->validate([
        'commande_id' => 'required|exists:commandes,id',
        'dateDebut' => 'required|date',
        'dateFin' => 'required|date',
    ]);

    try {
        $commande = Commande::findOrFail($request->input('commande_id'));
        $dateDebut = $request->input('dateDebut');
        $dateFin = $request->input('dateFin');
        
        // Récupérer l'utilisateur associé à la commande
        $user = User::find($commande->userId);

        // Vérifier si l'utilisateur existe
        if ($commande->mailClient) {
            Mail::to($commande->mailClient)->send(new CommandeTerminee($commande, $user,$dateDebut,$dateFin));
        }
        if ($user) {
            // Envoi de l'e-mail de commande terminée avec les informations sur l'utilisateur
            Mail::to('alikallebi74@gmail.com')->send(new CommandeTerminee($commande, $user,$dateDebut,$dateFin));

            return response()->json(['message' => 'E-mail envoyé avec succès pour la commande terminée'], 200);
        } else {
            return response()->json(['error' => 'Aucun utilisateur associé à cette commande.'], 500);
        }
    } catch (\Exception $e) {
        return response()->json(['error' => 'Une erreur s\'est produite lors de l\'envoi de l\'e-mail : ' . $e->getMessage()], 500);
    }
}

    
public function sendMailRejetee(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'rejectionReason' => 'required|string',
            'rejectionDate' => 'required|date',
        ]);

        try {
            $commande = Commande::findOrFail($request->input('commande_id'));
            $rejectionReason = $request->input('rejectionReason');
            $rejectionDate = $request->input('rejectionDate');

            $user = User::find($commande->userId);


            if ($commande->mailClient) {
                Mail::to($commande->mailClient)->send(new CommandeRejetee($commande, $user, $rejectionReason, $rejectionDate));
            }

            if ($user) {
                Mail::to('alikallebi74@gmail.com')->send(new CommandeRejetee($commande, $user, $rejectionReason, $rejectionDate));

                return response()->json(['message' => 'E-mail envoyé avec succès pour la commande rejetée'], 200);
            } else {
                return response()->json(['error' => 'Aucun utilisateur associé à cette commande.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur s\'est produite lors de l\'envoi de l\'e-mail : ' . $e->getMessage()], 500);
        }
    }
    public function sendMeilleurOuvrierEmail()
    {
        // Récupérer l'utilisateur avec la période la plus courte et exclure les spécialités RH
        $meilleurOuvrier = User::where('specialite', '!=', 'RH')
                               ->orderByRaw('CAST(periode AS UNSIGNED)')
                               ->first();
    
        if ($meilleurOuvrier) {
            // Ajoutez l'URL de l'avatar du meilleur ouvrier
            $meilleurOuvrier->avatar_url = url('storage/avatars/' . $meilleurOuvrier->avatar);
    
            // Envoyer un email à chaque utilisateur pour les informer du meilleur ouvrier
            $users = User::all();
            foreach ($users as $user) {
                Mail::to($user->email)->send(new MeilleurOuvrierNotification($meilleurOuvrier));
            }
    
            return response()->json(['message' => 'Notifications envoyées à tous les utilisateurs.'], 200);
        }
    
        return response()->json(['message' => 'Aucun ouvrier trouvé.'], 404);
    }
    
}    
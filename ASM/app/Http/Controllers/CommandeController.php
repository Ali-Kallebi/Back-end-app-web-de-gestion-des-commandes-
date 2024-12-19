<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;


class CommandeController extends Controller
{
    public function index()
    {
        try {
            // Récupérer toutes les commandes avec les relations (si nécessaire)
            $commandes = Commande::all();

            // Retourner les données au format JSON
            return response()->json($commandes);
        } catch (\Exception $e) {
            // En cas d'erreur, retourner un message d'erreur
            return response()->json(['error' => 'Une erreur s\'est produite lors de la récupération des commandes'], 500);
        }
    }

    // Méthode pour récupérer les commandes par statut
    public function getByStatus($status)
    {
        try {
            // Filtrer les commandes par statut
            $commandes = Commande::where('status', $status)->get();

            // Retourner les données au format JSON
            return response()->json($commandes);
        } catch (\Exception $e) {
            // En cas d'erreur, retourner un message d'erreur
            return response()->json(['error' => 'Une erreur s\'est produite lors de la récupération des commandes par statut'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // Créer une nouvelle commande à partir des données reçues
            $commande = new Commande();
            $commande->fill($request->all()); // Remplir la commande avec les données du formulaire
            $commande->save();

            // Retourner la commande créée avec le code 201 (Created)
            return response()->json($commande, 201);
        } catch (\Exception $e) {
            // En cas d'erreur, retourner un message d'erreur
            return response()->json(['error' => 'Une erreur s\'est produite lors de la création de la commande'], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $commande = Commande::findOrFail($id);
    
            // Mettre à jour le statut de la commande avec la valeur fournie dans la requête
            $commande->status = $request->input('status');
            $commande->save();
    
            // Retourner la commande mise à jour
            return response()->json($commande);
        } catch (\Exception $e) {
            // En cas d'erreur, retourner un message d'erreur
            return response()->json(['error' => 'Une erreur s\'est produite lors de la mise à jour du statut de la commande'], 500);
        }
    }
    public function affecterCommande(Request $request, $id)
{
    try {
        $commande = Commande::findOrFail($id);
        $commande->userId = $request->input('userId'); // Récupérer userId depuis la requête
        $commande->save();

        return response()->json($commande);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Erreur lors de l\'affectation de la commande à l\'utilisateur'], 500);
    }
}
public function rejectCommande(Request $request, $id)
{
    try {
        $commande = Commande::findOrFail($id);
        $commande->rejectionReason = $request->input('rejectionReason'); // Récupérer la raison du rejet depuis la requête
        $commande->rejectionDate = now(); // Utiliser la date actuelle comme date de rejet
        $commande->save();

        return response()->json($commande);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Erreur lors de la mise à jour de la commande rejetée'], 500);
    }
}
public function termineCommande(Request $request, $id)
{
    try {
        $commande = Commande::findOrFail($id);

        // Convertir les dates en objets DateTime
        $dateDebutConvertie = new DateTime($request->input('dateDebut'));
        $dateFinConvertie = new DateTime($request->input('dateFin'));

        // Assurez-vous que les dates sont correctement formatées pour Laravel
        $commande->dateDebut = $dateDebutConvertie->format('Y-m-d H:i:s');
        $commande->dateFin = $dateFinConvertie->format('Y-m-d H:i:s');
        
        // Si la commande n'est pas trouvée
        if (!$commande) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }

        $dateDebut = Carbon::parse($commande->dateDebut);
        $dateFin = Carbon::parse($commande->dateFin);
        $diff = $dateDebut->diff($dateFin);

        // Ajouter la différence au tableau de la commande
        $commande->duration = $diff->format('%d jours, %h heures, %i minutes');

        // Enregistrez les modifications
        $commande->save();

        // Mettre à jour le nombre de commandes terminées et la période de l'utilisateur associé à cette commande
        $userId = $commande->userId;
        $user = User::findOrFail($userId);
        $user->nombreCommandesTerminees += 1; // Incrémenter le nombre de commandes terminées
        
        // Calculer la durée totale des commandes de cet utilisateur
        $commandesUser = Commande::where('userId', $userId)->get();
        $totalDurationInMinutes = 0;

        foreach ($commandesUser as $cmd) {
            $dateDebutCmd = Carbon::parse($cmd->dateDebut);
            $dateFinCmd = Carbon::parse($cmd->dateFin);
            $diffCmd = $dateDebutCmd->diffInMinutes($dateFinCmd);
            $totalDurationInMinutes += $diffCmd;
        }

        // Calculer la période moyenne en minutes
        $periodeMoyenne = $totalDurationInMinutes / $user->nombreCommandesTerminees;

        // Stocker la période moyenne en minutes
        $user->periode = $periodeMoyenne;

        $user->save();

        return response()->json($commande);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Erreur lors de la mise à jour de la commande Terminée'], 500);
    }
}


public function affecteCommande(Request $request, $id)
{
    try {
        $commande = Commande::findOrFail($id);
        $commande->description = $request->input('description'); // Récupérer la raison du rejet depuis la requête
        $commande->date_affecte = now(); // Utiliser la date actuelle comme date de rejet
        $commande->save();

        return response()->json($commande);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Erreur lors de la mise à jour de la commande affecter'], 500);
    }

}

// CommandeController.php

public function getEnAttente()
{
    try {
        // Récupérer les commandes avec le statut 'En attend'
        $commandesEnAttente = Commande::where('status', 'En attente')->get();

        // Retourner les données au format JSON
        return response()->json($commandesEnAttente);
    } catch (\Exception $e) {
        // En cas d'erreur, retourner un message d'erreur
        return response()->json(['error' => 'Une erreur s\'est produite lors de la récupération des commandes en attente'], 500);
    }
}
public function summary()
{
    try {
        $totalClients = Commande::distinct('mailClient')->count();
        $totalCommandesEnAttente = Commande::where('status', 'En attente')->count();
        $totalMontantCommandes = Commande::sum('montant_total');
        $totalCommandes = Commande::count();
        $totalUsers = User::count();
        $totalRH= User::where('specialite','RH')->count();

        $commandesParDate = Commande::selectRaw('MONTH(dateLivraison) as month, COUNT(*) as totalCommandes, COUNT(DISTINCT mailClient) as totalClients')
            ->groupBy('month')
            ->get();

        $produitCommandes = Commande::selectRaw('produitCommande, SUM(montant_total) as montantTotal')
            ->whereMonth('dateLivraison', 6)
            ->whereIn('produitCommande', ['PRO:RESTO', 'PRO:CLEAN', 'PRO:MAG', 'PRO:PAT', 'PRO:BEAUTY'])
            ->groupBy('produitCommande')
            ->get();

        $packCommandes = Commande::selectRaw('produitCommande, SUM(montant_total) as montantTotal')
            ->whereMonth('dateLivraison', 6)
            ->whereIn('produitCommande', ['PACK:RESTO/CAFEE', 'PACK:MODE', 'PACK:LOC SYS', 'PACK:PARA', 'PACK:PATESSIRIE/BOULANGERIE'])
            ->groupBy('produitCommande')
            ->get();

        $summaryData = [
            'totalClients' => $totalClients,
            'totalCommandesEnAttente' => $totalCommandesEnAttente,
            'totalMontantCommandes' => $totalMontantCommandes,
            'totalCommandes' => $totalCommandes,
            'totalUsers'  => $totalUsers,
            'commandesParDate' => $commandesParDate,
            'produitCommandes' => $produitCommandes,
            'packCommandes' => $packCommandes,
            'totalRH'=>  $totalRH,
        ];

        return response()->json($summaryData);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Une erreur s\'est produite lors du calcul du résumé des commandes'], 500);
    }
}

}

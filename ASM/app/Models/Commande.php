<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomClient', 'prenomClient', 'telClient','mailClient', 'localisation', 'dateLivraison',
         'produitCommande', 'montant_total', 'status','userId','rejectionReason', 'rejectionDate',
         'description','date_affecte','dateDebut','dateFin','duration',
    ];
}

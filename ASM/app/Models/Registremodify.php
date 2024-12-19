<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registremodify extends Model
{
    protected $table = 'registremodify'; // Nom de la table dans la base de données

    protected $fillable = [ // Liste des colonnes pouvant être remplies
        'nom',
        'email',
        'password',
        'prenom',
        'tel',
        'specialite',
        'localisation',
    ];

    // Vous pouvez également définir d'autres propriétés et méthodes selon vos besoins
}

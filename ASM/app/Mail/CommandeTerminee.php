<?php
namespace App\Mail;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommandeTerminee extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;
    public $user;
    public $dateDebut;
    public $dateFin;
    

    public function __construct(Commande $commande, User $user,$dateDebut,$dateFin)
    {
        $this->commande = $commande;
        $this->user = $user;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
    }

    public function build()
    {
        return $this->subject('Commande Terminée')
                    ->view('emails.commande-terminee');
    }
}

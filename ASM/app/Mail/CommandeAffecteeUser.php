<?php
namespace App\Mail;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommandeAffecteeUser extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;
    public $user;
    public $description;
    public $date_affecte;

    public function __construct(Commande $commande, User $user, $description, $date_affecte)
    {
        $this->commande = $commande;
        $this->user = $user;
        $this->description = $description;
        $this->date_affecte = $date_affecte;
    }

    public function build()
    {
        return $this->view('emails.commande-affectee-user')
            ->subject("Notification de l'affectation d'une commande")
            ->with([
                'user' => $this->user,
                'description' => $this->description,
                'date_affecte' => $this->date_affecte,
            ]);
    }
}

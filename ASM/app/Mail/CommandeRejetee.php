<?php
namespace App\Mail;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommandeRejetee extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;
    public $user;
    public $rejectionReason;
    public $rejectionDate;

    public function __construct(Commande $commande, User $user, $rejectionReason, $rejectionDate)
    {
        $this->commande = $commande;
        $this->user = $user;
        $this->rejectionReason = $rejectionReason;
        $this->rejectionDate = $rejectionDate;
    }

    public function build()
    {
        return $this->subject('Commande Rejetée')->view('emails.commande-rejetee');
    }
}

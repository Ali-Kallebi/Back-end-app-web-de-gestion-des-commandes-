<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class MeilleurOuvrierNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $meilleurOuvrier;

    public function __construct(User $meilleurOuvrier)
    {
        $this->meilleurOuvrier = $meilleurOuvrier;
        // Assurez-vous que l'URL de l'avatar est complète
        $this->meilleurOuvrier->avatar_url = url('storage/avatars/' . $meilleurOuvrier->avatar); // Modifiez le chemin en fonction de votre configuration
    }

    public function build()
    {
        return $this->view('emails.meilleur-ouvrier-notification')
                    ->with('meilleurOuvrier', $this->meilleurOuvrier);
    }
}

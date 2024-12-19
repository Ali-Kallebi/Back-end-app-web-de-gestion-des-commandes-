<!-- reset.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
    <style>
        .surface-0 {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            min-width: 100vw;
            overflow: hidden;
        }
        .grid {
            display: grid;
            justify-content: center;
            padding: 1rem;
            min-width: 70%; /* Ajuster la largeur minimale de la fenêtre */
        }
        .col-12.xl-6 {
            border-radius: 1rem; /* Réduire le rayon de bordure */
            padding: 1rem; /* Réduire le rembourrage */
            background: linear-gradient(180deg, rgba(247, 149, 48, 0.4) 10%, rgba(247, 149, 48, 0) 30%);
        }
        .h-full {
            height: 100%;
        }
        .w-full {
            width: 100%;
        }
        .py-7 {
            padding-top: 1rem; /* Ajuster le padding en haut */
            padding-bottom: 1rem; /* Ajuster le padding en bas */
        }
        .px-4 {
            padding-left: 0.5rem; /* Réduire le padding à gauche */
            padding-right: 0.5rem; /* Réduire le padding à droite */
        }
        .text-3xl {
            font-size: 1.5rem; /* Réduire la taille de la police */
        }
        .text-xl {
            font-size: 0.9rem; /* Réduire la taille de la police */
        }
        .p-3 {
            padding: 0.5rem; /* Réduire le padding */
        }
        /* Ajustements spécifiques aux champs de formulaire */
        button[type="submit"] {
            padding: 0.5rem; /* Réduire le padding */
            font-size: 0.9rem; /* Réduire la taille de la police */
            width: 100%; /* Définir la largeur sur 100% */
        }
        a {
            text-decoration: none; /* Supprimer la soulignement des liens */
            color: #007bff; /* Définir la couleur du lien */
        }
    </style>
</head>
<body>
    <div class="surface-0">
        <div class="grid">
            <div class="col-12 xl-6">
                <div class="h-full w-full m-0 py-7 px-4">
                    <div class="text-center mb-3">
                        <div class="text-900 text-3xl font-medium mb-1">Password Reset</div>
                    </div>
                    <p>Vous avez demandé la réinitialisation de votre mot de passe. Si vous souhaitez réinitialiser votre mot de passe, 
                    <button type="submit" class="w-full p-3 text-xl">
                        <a href="http://localhost:4200/#/auth/reset-password?token={{ $token }}&email={{ $email }}">Clique Ici</a>
                    </button></p>
                    <p>Ouvrez votre navigateur web et copiez-collez l'URL suivante : 
                    http://localhost:4200/auth/reset-password?token={{ $token }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

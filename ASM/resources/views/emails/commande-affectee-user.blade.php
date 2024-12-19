<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification d'affectation de commande</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            color: #fff;
            text-align: center;
        }
        h2 {
            color: #4CAF50;
        }
        p {
            line-height: 1.6;
        }
        .details-list {
            list-style: none;
            padding: 0;
        }
        .details-list li {
            background-color: #f9f9f9;
            margin-bottom: 10px;
            padding: 10px;
            border-left: 5px solid #4CAF50;
        }
        .highlight {
            color: #4CAF50;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #999;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>Notification d'affectation d'une commande</h2>
        </div>
        
        <p>Bonjour <span class="highlight">{{ $user->prenom }} {{ $user->nom }}</span>,</p>

        <p>Nous avons le plaisir de vous informer que vous avez été affecté à une nouvelle commande :</p>

        <ul class="details-list">
            <li><strong>ID de commande :</strong> {{ $commande->id }}</li>
            <li><strong>Nom du client :</strong> {{ $commande->nomClient }}</li>
            <li><strong>Prénom du client :</strong> {{ $commande->prenomClient }}</li>
            <li><strong>Téléphone du client :</strong> {{ $commande->telClient }}</li>
            <li><strong>Localisation :</strong> {{ $commande->localisation }}</li>
            <li><strong>Date de livraison :</strong> {{ $commande->dateLivraison }}</li>
            <li><strong>Produit commandé :</strong> {{ $commande->produitCommande }}</li>
            <li><strong>Montant total :</strong> {{ $commande->montant_total }}</li>
        </ul>

        <h2>Date d'affectation</h2>  
        <p><span class="highlight">{{ $date_affecte }}</span></p>
        
        <h2>Remarques</h2> 
        <p><span class="highlight">{{ $description }}</span></p>
        
        <p>Merci pour votre collaboration.</p>

        <div class="footer">
            <p>&copy; 2024 Votre Société. Tous droits réservés.</p>
        </div>
    </div>

</body> 
</html>

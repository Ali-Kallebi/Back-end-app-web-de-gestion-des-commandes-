<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affectation de commande</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #fff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }
        h2 {
            color: #4CAF50;
        }
        p {
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .highlight {
            color: #4CAF50;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Affectation d'une commande de programmation de caisses tactiles</h2>
        
        <p>Bonjour <span class="highlight">{{ $commande->prenomClient }} {{ $commande->nomClient }}</span>,</p>

        <p>Je vous informe que <span class="highlight">{{ $user->prenom }} {{ $user->nom }}</span> a été chargé de traiter votre commande :</p>

        <table>
            <tr>
                <th>ID de commande</th>
                <td>{{ $commande->id }}</td>
            </tr>
            <tr>
                <th>Nom du client</th>
                <td>{{ $commande->nomClient }}</td>
            </tr>
            <tr>
                <th>Prénom du client</th>
                <td>{{ $commande->prenomClient }}</td>
            </tr>
            <tr>
                <th>Téléphone du client</th>
                <td>{{ $commande->telClient }}</td>
            </tr>
            <tr>
                <th>Localisation</th>
                <td>{{ $commande->localisation }}</td>
            </tr>
            <tr>
                <th>Date de livraison</th>
                <td>{{ $commande->dateLivraison }}</td>
            </tr>
            <tr>
                <th>Produit commandé</th>
                <td>{{ $commande->produitCommande }}</td>
            </tr>
            <tr>
                <th>Montant total</th>
                <td>{{ $commande->montant_total }}</td>
            </tr>
        </table>

        <h2>Date d'affectation</h2>  
        <p><span class="highlight">{{ $date_affecte }}</span></p>

        <p>Merci pour votre collaboration.</p>
    </div>

</body> 
</html>

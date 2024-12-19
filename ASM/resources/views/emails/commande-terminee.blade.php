<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande Terminée</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6dd5ed, #2193b0);
            color: #333;
            padding: 20px;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        h2 {
            color: #2193b0;
        }
        h3 {
            color: #6dd5ed;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #2193b0;
            color: #fff;
        }
        .date {
            display: block;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            background: #f7f7f7;
            border: 1px solid #ddd;
        }
        .footer {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Commande de {{ $user->nom }} {{ $user->prenom }}</h2>
        <p>Salut,</p>
        <p>Je vous informe que la commande suivante a été marquée comme terminée :</p>
        
        <table>
            <tr>
                <th>Information</th>
                <th>Détail</th>
            </tr>
            <tr>
                <td>ID de la commande</td>
                <td>{{ $commande->id }}</td>
            </tr>
            <tr>
                <td>Nom du client</td>
                <td>{{ $commande->nomClient }} {{ $commande->prenomClient }}</td>
            </tr>
            <tr>
                <td>Téléphone du client</td>
                <td>{{ $commande->telClient }}</td>
            </tr>
            <tr>
                <td>Email du client</td>
                <td>{{ $commande->mailClient }}</td>
            </tr>
            <tr>
                <td>Localisation</td>
                <td>{{ $commande->localisation }}</td>
            </tr>
            <tr>
                <td>Produit commandé</td>
                <td>{{ $commande->produitCommande }}</td>
            </tr>
            <tr>
                <td>Date de livraison</td>
                <td>{{ $commande->dateLivraison }}</td>
            </tr>
            <tr>
                <td>Montant total</td>
                <td>{{ $commande->montant_total }}</td>
            </tr>
        </table>
        
        <h3>Période de branchement et programmation:</h3>
        <table>
            <tr>
                <th>Date Début</th>
                <th>Date Fin</th>
            </tr>
            <tr>
                <td><span class="date">{{ $dateDebut }}</span></td>
                <td><span class="date">{{ $dateFin }}</span></td>
            </tr>
        </table>
        
        <p>Merci pour votre commande.</p>
        <p class="footer">Cordialement,</p>
        <p class="footer">ASM</p>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Meilleur Ouvrier</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lobster|Rokkitt" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .envelope {
            background: white;
            padding: 20px;
            border: 2px solid #000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            text-align: center;
        }
        .avatar-container {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #007bff;
        }
        .avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .content {
            padding: 20px;
        }
        h3 {
            margin: 10px 0;
            color: #007bff;
        }
        .image-container {
            text-align: center;
            margin-top: 20px;
        }
        .centered-image {
            max-width: 80%; /* Ajustez cette valeur selon votre besoin */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="envelope">
            <div class="content">
                <h2>السلام عليكم<h2>
                <p>Nous sommes heureux de vous informer que <h3>{{ $meilleurOuvrier->nom }} {{ $meilleurOuvrier->prenom }}</h3> a été désigné comme le meilleur ouvrier de ce mois.</p>
                <p>Il a terminé <h3>{{ $meilleurOuvrier->nombreCommandesTerminees }}</h3> commandes dans une période de <h3>{{ $meilleurOuvrier->periode }}</h3> minutes.</p>
                <p>Merci pour votre contribution et vos efforts continus.</p>
                <p>Bien à vous,</p>
                <p>Votre équipe</p>
            </div>
        </div>
    </div>

    <div class="image-container">
        <img src="https://www.toutpratique.com/img/cms/Nouveau%20dossier/avril/mai%20juin%2021/felicitations--10-cartes-gratuites-10-modeles-textes-felicitation-pour-bons-resultats-scolaires-toutpratique.jpg" alt="Bravo" class="centered-image" />
    </div>
</body>
</html>

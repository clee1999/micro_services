# Guide d'initialisation du projet

 1. `composer install` dans /reservation/api/ puis `php -S localhost:8002`
 2. `composer install` dans /user/api/ puis `php -S localhost:8000`
 3.  Créer un dossier "Controller" dans /crenaux/api/src/ et `composer install` dans /crenaux/api/ puis `php -S localhost:8001`
 4. `npm install` dans app

 # Problèmes
 En cas de probème lors de la génération des JWT token sur les users, il faut regénérer les clés SSL avec la commande `php bin/console lexik:jwt:generate-keypair`

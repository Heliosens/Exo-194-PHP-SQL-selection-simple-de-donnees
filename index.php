<?php

/**
 * 1. Importez le fichier SQL se trouvant dans le dossier SQL.
 * 2. Connectez vous à votre base de données avec PHP
 * 3. Sélectionnez tous les utilisateurs et affichez toutes les infos proprement dans un div avec du css
 *    ex:  <div class="classe-css-utilisateur">
 *              utilisateur 1, données ( nom, prenom, etc ... )
 *         </div>
 *         <div class="classe-css-utilisateur">
 *              utilisateur 2, données ( nom, prenom, etc ... )
 *         </div>
 * 4. Faites la même chose, mais cette fois ci, triez le résultat selon la colonne ID, du plus grand au plus petit.
 * 5. Faites la même chose, mais cette fois ci en ne sélectionnant que les noms et les prénoms.
 */

require 'connPDO.php';
$pdo = new connPDO();
$db = $pdo->conn();

$stm = $db->prepare("SELECT * from user");
$stm->execute()
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <section><?php
    foreach ($stm->fetchAll() as $user){?>
        <div class="result">
            <?="Utilisateur " . $user['id'] . " " . $user['nom'] . " " . $user['prenom'] . " " . $user['numero'] . " " .
            $user['rue'] . " " . $user['code_postal'] . " " . $user['ville'] . " " . $user['pays'] . '<br>'?>
        </div>
        <?php
    }
    ?>
    </section>
    <section><?php
        $stm = $db->prepare("SELECT * from user ORDER BY id DESC");
        $stm->execute();
        foreach ($stm->fetchAll() as $user){?>
        <div class="result">
            <?="Utilisateur " . $user['id'] . " " . $user['nom'] . " " . $user['prenom'] . " " . $user['numero'] . " " .
            $user['rue'] . " " . $user['code_postal'] . " " . $user['ville'] . " " . $user['pays'] . '<br>'?>
        </div>
        <?php
    }
    ?>
    </section>
    <section><?php
        $stm = $db->prepare("SELECT nom, prenom from user");
        $stm->execute();
        foreach ($stm->fetchAll() as $user){?>
            <div class="result">
                <?="Utilisateur : " . $user['nom'] . " " . $user['prenom'] . '<br>'?>
            </div>
            <?php
        }
        ?>
    </section>
</body>
</html>

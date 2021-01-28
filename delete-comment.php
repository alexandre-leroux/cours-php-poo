<?php
require_once ('libraries/database.php');
require_once ('libraries/utils.php');

if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ! Fallait préciser le paramètre id en GET !");
}

$id = $_GET['id'];

$commentaire = findComment($id);
$article_id = $commentaire['article_id'];
if (!$commentaire) {
    die("Aucun commentaire n'a l'identifiant $id !");
}

deleteComent($id);

redirect("article.php?id=". $article_id);





<?php
require_once ('libraries/utils.php');
require_once ('libraries/database.php');

$article_id = null;

// Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $article_id = $_GET['id'];
}

// On peut désormais décider : erreur ou pas ?!
if (!$article_id) {
    die("Vous devez préciser un paramètre `id` dans l'URL !");
}


// $article = $query->fetch();
$article = getArticle($article_id);
/**
 * 4. Récupération des commentaires de l'article en question
 * Pareil, toujours une requête préparée pour sécuriser la donnée filée par l'utilisateur (cet enfoiré en puissance !)
 */
// $query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
// $query->execute(['article_id' => $article_id]);
// $commentaires = $query->fetchAll();

$commentaires = getComment( $article_id);
/**
 * 5. On affiche 
 */
$pageTitle = $article['title'];
// ob_start();
// require('templates/articles/show.html.php');
// $pageContent = ob_get_clean();

// require('templates/layout.html.php');


render ( 'articles/show', compact('pageTitle','article','commentaires', 'article_id'));
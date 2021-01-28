<?php
require_once ('libraries/database.php');
require_once ('libraries/utils.php');
/**


 * 2. Récupération des articles
 */

$articles = findAllArticles();
/**
 * 3. Affichage
 */
$pageTitle = "Accueil";
// ob_start();
// require('templates/articles/index.html.php');
// $pageContent = ob_get_clean();

// require('templates/layout.html.php');
render ( 'articles/index', compact('pageTitle','articles'));
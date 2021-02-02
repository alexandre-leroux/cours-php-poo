<?php

namespace controllers;

// require_once('libraries/models/Article.php');
// require_once('libraries/controllers/Controller.php');

// require_once('libraries/models/Comment.php');
// require_once('libraries/autoload.php');


class Article extends Controller{


    protected $modelName = \models\Article::class;

    public function index()
        {

            $articles = $this->model ->findAll( "created_at DESC");
  
            $pageTitle = "Accueil";
    
            \Renderer::render ( 'articles/index', compact('pageTitle','articles'));
        }

    public function Show()
        {

            $article_id = null;

           
            $commentModel = new \models\Comment();

            // Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
            if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
                $article_id = $_GET['id'];
            }

            // On peut désormais décider : erreur ou pas ?!
            if (!$article_id) {
                die("Vous devez préciser un paramètre `id` dans l'URL !");
            }


            // $article = $query->fetch();
            $article = $this->model->find($article_id);


            $commentaires = $commentModel->findallWithArticle( $article_id);

            $pageTitle = $article['title'];

            \Renderer::render ( 'articles/show', compact('pageTitle','article','commentaires', 'article_id'));
        }


    public function delete()
        {

                if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
                    die("Ho ?! Tu n'as pas précisé l'id de l'article !");
                }

                $id = $_GET['id'];

                $article = $this->model-> find($id);
                if (!$article) {
                    die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
                }


                $this->model->delete($id);

                \Http::redirect("index.php");
        }

}
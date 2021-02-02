<?php

namespace controllers;





class Comment extends Controller
{

    protected $modelName = \models\Comment::class;




public function insert(){


            $articleModel = new \models\Article();

            $author = null;
            if (!empty($_POST['author'])) {
                $author = $_POST['author'];
            }

            // Ensuite le contenu
            $content = null;
            if (!empty($_POST['content'])) {
                // On fait quand même gaffe à ce que le gars n'essaye pas des balises cheloues dans son commentaire
                $content = htmlspecialchars($_POST['content']);
            }

            // Enfin l'id de l'article
            $article_id = null;
            if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
                $article_id = $_POST['article_id'];
            }

            // Vérification finale des infos envoyées dans le formulaire (donc dans le POST)
            // Si il n'y a pas d'auteur OU qu'il n'y a pas de contenu OU qu'il n'y a pas d'identifiant d'article
            if (!$author || !$article_id || !$content) {
                die("Votre formulaire a été mal rempli !");
            }


            $article = $articleModel-> find($article_id);

            // Si rien n'est revenu, on fait une erreur
            if (!$article) {
                die("Ho ! L'article $article_id n'existe pas boloss !");
            }

            // 3. Insertion du commentaire
            $this->model->insert( $author,  $content,  $article_id);


            \Http::redirect("article.php?id=" . $article_id);
        }


public function delete(){



            $articleModel = new \models\Article();


            if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
                die("Ho ! Fallait préciser le paramètre id en GET !");
            }

            $id = $_GET['id'];

            $commentaire = $this->model-> find($id);
            $article_id = $commentaire['article_id'];
            if (!$commentaire) {
                die("Aucun commentaire n'a l'identifiant $id !");
            }

            $this->model->delete($id);

            \Http::redirect("article.php?id=". $article_id);



        }


}
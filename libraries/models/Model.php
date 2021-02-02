<?php

namespace Models;




abstract class Model{


    protected $pdo;
    protected $table;

    public function __construct()
        {
            $this->pdo = \Database::getPdo();
        }



    public function find(int $id)
        {
            
            $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        
            // On exécute la requête en précisant le paramètre :article_id 
            $query->execute(['id' => $id]);
        
            // On fouille le résultat pour en extraire les données réelles de l'article
            return $item = $query->fetch();
             
        }



    public function delete(int $id): void
        {
            $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
            $query->execute(['id' => $id]);
        }


    public function findAll(?string $order = "") 
        {
            $sql = "SELECT * FROM {$this->table}";

            if ($order){
                $sql .= " ORDER BY " . $order;
            }
            $resultats = $this->pdo->query($sql);
            
            return $articles = $resultats->fetchAll();
        }

    public function findallWithArticle(int $id): array
        {
            $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE article_id = :article_id");
            $query->execute(['article_id' => $id]);
            return $commentaires = $query->fetchAll();
        }
    
    

}
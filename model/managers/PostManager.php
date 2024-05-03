<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct(){
        parent::connect();
    }


    // récupérer tous les posts d'un topic spécifique (par son id)
    public function findPostsByTopic($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." p 
                WHERE p.topic_id = :id
                ORDER BY p.creationDate";
        
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    
    // récupérer tous les posts d'un utilisateur spécifique (par son id)
    public function findPostsByUser($id) {

        $sql = "SELECT p1.topic_id, p2.dateLastMsg, p1.message, p2.nbPosts, u.pseudo AS userMsg
                FROM post p1
                JOIN
                (SELECT topic_id, MAX(creationDate) AS dateLastMsg, COUNT(topic_id) AS nbPosts
                FROM ".$this->tableName." p 
                WHERE p.user_id = :id
                GROUP BY topic_id ) p2
                ON p1.topic_id = p2.topic_id AND p1.creationDate = p2.dateLastMsg
                JOIN user u
                ON u.id_user = p1.user_id";
        
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }
}
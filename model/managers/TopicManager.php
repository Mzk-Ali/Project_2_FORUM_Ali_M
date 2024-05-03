<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct(){
        parent::connect();
    }

    
    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findTopicsByCategory($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.category_id = :id
                ORDER BY t.creationDate DESC";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }


    // récupérer tous les topics d'une catégorie spécifique (par son id) avec Nbr Post et dernier post
    public function findTopicsAndNbrPostByCategory($id) {

        $sql = "SELECT t.*, t.id_topic, p2.dateLastMsg, p1.message AS lastMsg, p2.nbPosts, u.pseudo AS userMsg
                FROM post p1
                JOIN
                (SELECT topic_id, MAX(creationDate) AS dateLastMsg, COUNT(topic_id) AS nbPosts
                FROM post
                GROUP BY topic_id ) p2
                ON p1.topic_id = p2.topic_id AND p1.creationDate = p2.dateLastMsg
                JOIN ".$this->tableName." t 
                ON t.id_topic = p1.topic_id
                JOIN user u
                ON u.id_user = p1.user_id
                WHERE t.category_id = :id";
        
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }


    // récupérer tous les topics d'un utilisateur spécifique (par son id)
    public function findTopicsByUser($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.user_id = :id";
        
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    // récupérer tous les topics d'un utilisateur spécifique (par son id) avec Nbr Post et dernier post
    public function findTopicsAndNbrPostByUser($id) {

        $sql = "SELECT t.*, t.id_topic, p2.dateLastMsg, p1.message AS lastMsg, p2.nbPosts, u.pseudo AS userMsg
                FROM post p1
                JOIN
                (SELECT topic_id, MAX(creationDate) AS dateLastMsg, COUNT(topic_id) AS nbPosts
                FROM post
                GROUP BY topic_id ) p2
                ON p1.topic_id = p2.topic_id AND p1.creationDate = p2.dateLastMsg
                JOIN ".$this->tableName." t 
                ON t.id_topic = p1.topic_id
                JOIN user u
                ON u.id_user = p1.user_id
                WHERE t.user_id = :id";
        
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }
}
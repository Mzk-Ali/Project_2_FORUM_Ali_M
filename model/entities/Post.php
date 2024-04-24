<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Post extends Entity{

    private $id;
    private $message;
    private $creationDate;
    private $user;
    private $topic;

    // chaque entité aura le même constructeur grâce à la méthode hydrate (issue de App\Entity)
    public function __construct($data){         
        $this->hydrate($data);        
    }



    
    // Get the value of id
    public function getId()
    {
        return $this->id;
    }

    // Set the value of id
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    // Get the value of message
    public function getMessage()
    {
        return $this->message;
    }

    // Set the value of message
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }


    // Get the value of creationDate
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    // Set the value of creationDate
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }




    // Get the value of user
    public function getUser()
    {
        return $this->user;
    }

    // Set the value of user
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }




    // Get the value of topic
    public function getTopic()
    {
        return $this->topic;
    }

    // Set the value of topic
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }



    public function __toString(){
        return $this->message;
    }
}
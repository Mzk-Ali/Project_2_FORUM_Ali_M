<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Topic extends Entity{

    private $id;
    private $title;
    private $creationDate;
    private $lock;
    private $user;
    private $category;
    private $nbPosts;
    private $dateLastMsg;
    private $userMsg;
    private $lastMsg;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    
    // Get the value of id
    public function getId(){
        return $this->id;
    }

    // Set the value of id
    public function setId($id){
        $this->id = $id;
        return $this;
    }


    // Get the value of title
    public function getTitle(){
        return $this->title;
    }

    // Set the value of title
    public function setTitle($title){
        $this->title = $title;
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


    // Get the value of lock
    public function getLock()
    {
        return $this->lock;
    }

    // Set the value of lock
    public function setLock($lock)
    {
        $this->lock = $lock;

        return $this;
    }


    // Get the value of user
    public function getUser(){
        return $this->user;
    }

    // Set the value of user
    public function setUser($user){
        $this->user = $user;
        return $this;
    }
    

    // Get the value of category
    public function getCategory()
    {
        return $this->category;
    }

    // Set the value of category
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }


    // Get the value of nbPosts
    public function getNbPosts()
    {
        return $this->nbPosts;
    }

    // Set the value of nbPosts
    public function setNbPosts($nbPosts)
    {
        $this->nbPosts = $nbPosts;

        return $this;
    }

    
    // Get the value of dateLastMsg
    public function getDateLastMsg()
    {
        return $this->dateLastMsg;
    }

    // Set the value of dateLastMsg
    public function setDateLastMsg($dateLastMsg)
    {
        $this->dateLastMsg = $dateLastMsg;

        return $this;
    }

    // Get the value of userMsg
    public function getUserMsg()
    {
        return $this->userMsg;
    }

    // Set the value of userMsg
    public function setUserMsg($userMsg)
    {
        $this->userMsg = $userMsg;

        return $this;
    }

    // Get the value of lastMsg
    public function getLastMsg()
    {
        return $this->lastMsg;
    }

    // Set the value of lastMsg
    public function setLastMsg($lastMsg)
    {
        $this->lastMsg = $lastMsg;

        return $this;
    }

    public function __toString(){
        return $this->title;
    }

}
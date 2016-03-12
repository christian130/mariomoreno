<?php

/**
 * @Entity @Table(name="wall")
 */
class Wall {

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;
    /** @Column(type="integer") */
    protected $author_id;
    /** @Column(type="integer") */
    protected $owner_id;
    /** @Column(type="string") */
    protected $text;
    /** @Column(type="string") */
    protected $link;
    /** @Column(type="string") */
    protected $link_title;
    /** @Column(type="string") */
    protected $link_description;
    /** @Column(type="date") */
    protected $link_photo;
    /** @Column(type="string") */
    protected $date;
  

    public function getId() {
        return $this->id;
    }
  
     public function getAuthorId() {
        return $this->author_id;
    }
    
     public function setAuthorId($author_id) {
        $this->author_id = $author_id;
    }
    
    public function getOwnerId() {
        return $this->owner_id;
    }
    
     public function setOwnerId($owner_id) {
        $this->owner_id = $owner_id;
    }
    
    public function getText() {
        return $this->text;
    }
    
     public function setText($text) {
        $this->text = $text;
    }
    
    public function getLink() {
        return $this->link;
    }
    
     public function setLink($link) {
        $this->link = $link;
    }
    
    public function getLinkTitle() {
        return $this->link_title;
    }
    
     public function setLinkTitle($link_title) {
        $this->link_title = $link_title;
    }
    
    public function getLinkDescription() {
        return $this->link_description;
    }
    
     public function setLinkDescription($link_description) {
        $this->link_description = $link_description;
    }
    
    public function getLinkPhoto() {
        return $this->link_photo;
    } 
   
     public function setLinkPhoto($link_photo) {
        $this->link_photo = $link_photo;
    }
    
    public function getDate() {
        return $this->date;
    }
    
     public function setDate($date) {
        $this->date= $date;
    }
    
}
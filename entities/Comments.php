<?php

/**
 * @Entity @Table(name="comments")
 */
class Comments {

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;
    /** @Column(type="integer") */
    protected $author_id;
    /** @Column(type="integer") */
    protected $post_id;
    /** @Column(type="string") */
    protected $text;
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
    
    public function getPostId() {
        return $this->post_id;
    }
    
     public function setPostId($post_id) {
        $this->post_id = $post_id;
    }
    
    public function getText() {
        return $this->text;
    }
    
     public function setText($text) {
        $this->text = $text;
    }
    
    public function getDate() {
        return $this->date;
    }
    
     public function setDate($date) {
        $this->date= $date;
    }
    
}
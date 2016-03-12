<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Mapping as ORM;

/**
 * @Entity(repositoryClass="AlbumRepository")  @Table(name="albums")
 */
class Album {

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id_album;

    /** @Column(type="integer") */
    protected $id_owner;
    
    /** @Column(type="integer") */
    protected $id_wall;

    /** @Column(type="string") */
    protected $title;

    /** @Column(type="integer") */
    protected $cover;
    
    /** @Column(type="integer") */
    protected $priv;

    /** @Column(type="string") */
    protected $datetime;

    public function __construct() {
        $this->setPrivate(1);
        $this->setDatetime();
    }

    public function getIdAlbum() {
        return $this->id_album;
    }

    public function setIdAlbum($id_album) {
        $this->id_album = $id_album;
    }

    public function getIdOwner() {
        return $this->id_owner;
    }

    public function setIdOwner($id_owner) {
        $this->id_owner = $id_owner;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getPrivate() {
        return $this->priv;
    }

    public function setPrivate($private) {
        $this->priv = $private;
    }

    public function getDatetime() {
        return $this->datetime;
    }

    public function setDatetime() {
        $this->datetime = date('Y-m-d H:i:s');
    }
    
    public function getIdWall() {
        return $this->id_wall;
    }

    public function setIdWall($id_wall) {
        $this->id_wall = $id_wall;
    }

    public function getCover() {
        return $this->cover;
    }

    public function setCover($cover) {
        $this->cover = $cover;
    }

        
     public function getPath(){        
        return 'uploads/'.$this->getIdOwner() . '/' . $this->getIdAlbum() . '/';
    }

}
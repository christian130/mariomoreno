<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Mapping as ORM;

/**
 * @Entity(repositoryClass="PhotoRepository")  @Table(name="photos")
 */
class Photo {

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id_photo;

    /** @Column(type="integer") */
    protected $id_album;

    /** @Column(type="integer") */
    protected $id_owner;

    /** @Column(type="string") */
    protected $title;

    /** @Column(type="string") */
    protected $datetime;

    public function __construct() {
        $this->setDatetime();
    }
    
    public function getIdPhoto() {
        return $this->id_photo;
    }

    public function setIdPhoto($id_photo) {
        $this->id_photo = $id_photo;
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

    public function getDatetime() {
        return $this->datetime;
    }

    public function setDatetime() {
        $this->datetime = date('Y-m-d H:i:s');
    }

}
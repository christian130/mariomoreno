<?php

/**
 * @Entity @Table(name="photos")
 */
class Photos {

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;
    /** @Column(type="integer") */
    protected $wall_id;
    /** @Column(type="string") */
    protected $file;
    /** @Column(type="string") */
    protected $date;

    public function getId() {
        return $this->id;
    }
  
     public function getWallId() {
        return $this->wall_id;
    }
    
     public function setWallId($wall_id) {
        $this->wall_id = $wall_id;
    }
    
    public function getFile() {
        return $this->file;
    }
    
     public function setFile($file) {
        $this->file = $file;
    }
    
    public function getDate() {
        return $this->date;
    }
    
     public function setDate($date) {
        $this->date= $date;
    }
    
}
<?php

/**
 * @Entity(repositoryClass="FriendRepository")  @Table(name="friends")
 */
class Friend {

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;
    /** @Column(type="integer") */
    protected $id_owner;
    /** @Column(type="integer") */
    protected $id_friend;
    /** @Column(type="integer") */
    protected $status;
    
  
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdOwner() {
        return $this->id_owner;
    }

    public function setIdOwner($id_owner) {
        $this->id_owner = $id_owner;
    }

    public function getIdFriend() {
        return $this->id_friend;
    }

    public function setIdFriend($id_friend) {
        $this->id_friend = $id_friend;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }



    
}
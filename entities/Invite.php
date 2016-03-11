<?php

/**
 * @Entity(repositoryClass="FriendRepository")  @Table(name="friends")
 */
class Invite{

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;
    /** @Column(type="integer") */
    protected $user_id;
    /** @Column(type="string") */
    protected $email;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

         

    public function setEmail($email) {
        $this->email = $email;
    }
    public function getEmail() {
        return $this->email;
    }


    
}
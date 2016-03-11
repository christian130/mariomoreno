<?php

/**
 * @Entity @Table(name="work")
 */
class Work {

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $work_id;
    /** @Column(type="string") */
    protected $company;
    /** @Column(type="integer") */
    protected $user_id;


    public function getWorkId() {
        return $this->work_id;
    }

    public function getCompany($company) {
        return $this->company;
    }

    public function setCompany($company) {
        $this->company = $company;
    }

    public function getScreenName() {
        return $this->screen_name;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

}
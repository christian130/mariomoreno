<?php

/**
 * @Entity @Table(name="work")
 */
class Education {

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $education_id;
    /** @Column(type="string") */
    protected $school_name;
    /** @Column(type="integer") */
    protected $user_id;

    public function getEducationId() {
        return $this->education_id;
    }

    public function getSchoolName($school_name) {
        return $this->school_name;
    }

    public function setSchoolName($school_name) {
        $this->school_name = $school_name;
    }
    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

}
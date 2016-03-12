<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * @Entity @Table(name="location")
 */
class Location {

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;
    /** @Column(type="string") */
    protected $country;
    /** @Column(type="string") */
    protected $city;



    public function getId() {
        return $this->id;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

}
?>
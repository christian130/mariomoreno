<?php

/**
 * @Entity @Table(name="sh_users")
 */
class UserRegister {

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $user_id;
    /** @Column(type="string") */
    protected $firstname;
    /** @Column(type="string") */
    protected $home;
    /** @Column(type="string") */
    protected $lastname;
    /** @Column(type="string") */
    protected $email;
    /** @Column(type="string") */
    protected $password;
    /** @Column(type="string") */
    protected $photo;
    /** @Column(type="string") */
    protected $activation;
    /** @Column(type="date") */
    protected $dob;
    /** @Column(type="string") */
    protected $activated;
    /** @Column(type="string") */
    protected $sessionid;
    /** @Column(type="string") */
    protected $registeration_status;
    /** @Column(type="string") */
    protected $current_city;
    /** @Column(type="string") */
    protected $home_city;
    /** @Column(type="string") */
    protected $profile_pic;
    /** @Column(type="date") */
    protected $registerdate;
    /** @Column(type="string") */
    protected $last_login;
    /**@Column(type="string")*/
    protected $aboutyou;
    /**@Column(type="string")*/
    protected $phonenumber;
    /**@Column(type="string")*/
    protected $gender;
    /**@Column(type="string")*/
    protected $interested;
    /**@Column(type="string")*/
    protected $relationship;
    /**@Column(type="string")*/
    protected $politicalview;
    /**@Column(type="string")*/
    protected $religion;
    /**@Column(type="string")*/
    protected $language;
    /**@column(type="string")*/
    protected $listinterest;
     /**@Column(type="string")*/
    protected $work;
    /**@column(type="string")*/
    protected $education;
    /**@column(type="string")*/
    protected $cover_photo;
 /**@column(type="string")*/
    protected $forgotpwd;
    /**@column(type="string")*/
    protected $orginalpic;

    public function getUser_id() {
        return $this->user_id;
    }
     public function getOrginalPic(){
        return $this->orginalpic;
    }
    public function setOrginalPic($orginalpic){
        $this->orginalpic = $orginalpic;
    }
    public function getCoverPhoto(){
        return $this->cover_photo;
    }
    public function setCoverPhoto($cover_photo){
        $this->cover_photo = $cover_photo;
    }
    public function getWork(){
        return $this->work;
    }
    public function setWork($work){
        $this->work = $work;
    }
    public function getEducation(){
        return $this->education;
    }
    public function setEducation($education){
        $this->education = $education;
    }
    public function getListInterest(){
        return $this->listinterest;
    }
    public function setListInterest($listinterest){
        $this->listinterest = $listinterest;
    }
    public function getInterested(){
        return $this->interested;
    }
    public function setInterested($interested){
        $this->interested = $interested;
    }
    public function getRelationship(){
        return $this->relationship;
    }
    public function setRelationship($relationship){
        $this->relationship = $relationship;
    }
    public function getPoliticalView(){
        return $this->politicalview;
    }
    public function setPoliticalView($politicalview){
        $this->politicalview = $politicalview;
    }
    public function getReligion(){
        return $this->religion;
    }
    public function setReligion($religion){
        $this->religion = $religion;
    }
    public function getHome(){
        return $this->home;
    }
    public function setHome($home){
        $this->home = $home;
    }
    public function getLanguage(){
        return $this->language;
    }
    public function setLanguage($language){
        $this->language = $language;
    }
    public function getGender(){
        return $this->gender;
    }
    public function setGender($gender){
        $this->gender = $gender;
    }
    public function getPhoneNumber(){
        return $this->phonenumber;
    }
    public function setPhoneNumber($phonenumber){
        $this->phonenumber = $phonenumber;
    }
    public function getAboutYou(){
        return $this->aboutyou;
    }
    public function setAboutYou($aboutyou){
        $this->aboutyou = $aboutyou;
    }
    public function setSignupDate($registerdate) {
        $this->registerdate = $registerdate;
    }

    public function getSignupDate() {
        return $this->registerdate;
    }
    public function setLastLogin($last_login) {
        $this->last_login = $last_login;
    }

    public function getLastLogin() {
        return $this->last_login;
    }
    public function getSessionId() {
        return $this->sessionid;
    }

    public function setSessionId($sessionid) {
        $this->sessionid = $sessionid;
    }

    public function getRegStatus() {
        return $this->registeration_status;
    }

    public function setRegStatus($registeration_status) {
        $this->registeration_status = $registeration_status;
    }

    public function getFirstName() {
        return $this->firstname;
    }

    public function setCurrentCity($current_city) {
        $this->current_city = $current_city;
    }

    public function getCurrentCity() {
        return $this->current_city;
    }

    public function setHomeCity($home_city) {
        $this->home_city = $home_city;
    }

    public function getHomeCity() {
        return $this->profile_pic;
    }

    public function getProfilePic() {
        return $this->profile_pic;
    }

    public function setProfilePic($profile_pic) {
        $this->profile_pic = $profile_pic;
    }

    public function setFirstName($firstname) {
        $this->firstname = $firstname;
    }

    public function getLastName() {
        return $this->lastname;
    }

    public function setLastName($lastname) {
        $this->lastname = $lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    public function setActivation($activation) {
        $this->activation = $activation;
    }

    public function getActivation() {
        return $this->activation;
    }

    public function setDOB($dob) {
        $this->dob = $dob;
    }

    public function getDOB() {
        return $this->dob;
    }

    public function setActivated($activated) {
        $this->activated = $activated;
    }

    public function getActivated() {
        return $this->activated;
    }
    public function setForgotpwd($forgotpwd) {
        $this->forgotpwd = $forgotpwd;
    }

    public function getForgotpwd() {
        return $this->forgotpwd;
    }
}
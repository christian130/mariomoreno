<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Mapping as ORM;

/**
 * @Entity(repositoryClass="NotificationRepository") @Table(name="notifications")
 */
class Notification {

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id_notifications;
    /** @Column(type="integer") */
    protected $id_user;
    /** @Column(type="integer") */
    protected $id_friend;
    /** @Column(type="integer") */
    protected $type;
    /** @Column(type="string") */
    protected $message;
    /** @Column(type="integer") */
    protected $readed;
    /** @Column(type="string") */
    protected $date;
  public function __toString() {
        return $this->getIdUser() . ' - ' . $this->getMessage() . ' - ' . $this->getTypeText();
    }
    
    public function     __construct() {        
       /*  $this->datetime = date('d-m-Y H:i:s',  time()); */
	   $this->date = '' . date('Y-m-d H:i:s', time());
        $this->setId(NULL);
        $this->setRead(0);
    }
    public function getId() {
        return $this->id_notifications;
    }

    public function setId($id) {
        $this->id_notifications = $id;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function setIdUser($id_user) {
        $this->id_user = $id_user;
    }

    public function getIdFriend() {
        return $this->id_friend;
    }

    public function setIdFriend($id_friend) {
        $this->id_friend = $id_friend;
    }

    public function getType() {
        return $this->verifyType($this->type);
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getRead() {
        return $this->readed;
    }

    public function setRead($read) {
        $this->readed = $read;
    }

    public function getDate() {
        
        return $this->date ;
    }

    public function setDate() {
        $this->date = date('d-m-Y H:i:s',  time());
    }

    public function getDiffDate() {

        $inicio = strtotime($this->getDate());
        $fim = strtotime('' . date('Y-m-d H:i:s', time()));

# CALCULA A DIFERENÇA ENTRE AS DATAS
        $intervalo = $fim - $inicio;

# ESPECIFICO OS FATORES DE CÁLCULO DO INTERVALO
//        define('FATOR_ANO', (365 * 60 * 60 * 24));
//        define('FATOR_MES', (30 * 60 * 60 * 24));
//        define('FATOR_DIA', (60 * 60 * 24));
//        define('FATOR_HORA', (60 * 60));
//        define('FATOR_MINUTO', 60);
        $retorno = '';
        $meses = floor(($intervalo / FATOR_MES));
        if ($meses > 0) {
            $retorno = $meses . ' month(s) ago';
            return $retorno;
        }

        $dias = floor($intervalo / FATOR_DIA);
        if ($dia > 0) {
            
            $semanas = floor($dias / 7);
            
            if ($semanas >= 1){
                $retorno = $semanas . 'week';
                if($semanas == 1)$retorno .= ' ago';            
                else $retorno .= 's ago';                            
                return $retorno;
                }
            $retorno = $dias . ' day';
            if ($dia > 1)
                $retorno .= 's ago';
            else
                $retorno .= ' ago';
            return $retorno;
        }

        $horas = floor($intervalo / FATOR_HORA);
        if ($horas < 24 && $horas > 0) {
            $retorno = $horas . ' hour';
            if ($horas > 1)
                $retorno .= 's ago';
            else
                $retorno .= ' ago';
            return $retorno;
        }

        $minutos = floor($intervalo / FATOR_MINUTO);
        if ($minutos < 60 && $minutos>0) {
            $retorno = $minutos . ' minute';
            if ($minutos > 1)
                $retorno .= 's ago';
            else
                $retorno .= ' ago';
            return $retorno;
        }
        
        return $intervalo.' seconds ago'; 

#EM SEGUNDOS É A PRÓPRIA VARIÁVEL
    }
	public function getTypeText() {
        return $this->verifyType($this->getType());
    }
private function verifyType($type) {

        switch ($type) {
            case 1:
                return "Friendship Request";
                break;
            case 2:
                return "Friendship Accept";
                break;
            case 3:
                return "Photo Posted";
                break;
            case 4:
                return "Comment on your photo";
                break;
            case 5:
                return "Album Created";
                break;
            default:
                break;
        }
        return;
    }
    
}
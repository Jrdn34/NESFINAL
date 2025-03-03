<?php
require_once './classes/connexion.php';
class Ccard
{

    public $id;
    public $titre;
    public $description;
    public $date;
    function __construct($sid,  $stitre, $sdescription, $sdate) 
    {
        $this->id = $sid;
        $this->titre = $stitre;
        $this->description = $sdescription;
        $this->date = $sdate;
    }

    public function getPhotos($articleId)
    {
        $dao = new Connexion();
        $query = 'SELECT photo_url FROM photos WHERE article_id = :article_id';
        $sth = $dao->getObjetPDO()->prepare($query);
        $sth->execute(['article_id' => $articleId]);
        return $sth->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getVideos($articleId)
    {
        $dao = new Connexion();
        $query = 'SELECT video_url FROM videos WHERE article_id = :article_id';
        $sth = $dao->getObjetPDO()->prepare($query);
        $sth->execute(['article_id' => $articleId]);
        return $sth->fetchAll(PDO::FETCH_COLUMN);
    }
}

class Ccards
{
    private $ocollCardById;
    private $ocollCardByTitre;
    private $ocollCardByDescription;
    private $ocollCard;
    public function __construct()
    {


        try {
            $dao = new Connexion();

            $queryCard = 'SELECT * FROM articles';
            $lesCards = $dao->getTabData($queryCard);

            foreach ($lesCards as $uneCard) {
                $ocard = new Ccard($uneCard['id'], $uneCard['title'], $uneCard['description'], $uneCard['created_at']);
                $this->ocollCardById[$uneCard['id']] = $ocard;
                $this->ocollCardByTitre[$uneCard['title']] = $ocard;
                $this->ocollCardByDescription[$uneCard['description']] = $ocard;
                $this->ocollCard[] = $ocard;
            }
            unset($dao);
        } catch (PDOException $e) {
            $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
            die($msg);
        }
    }

    function GetAllCard()
    {
        return $this->ocollCard;
    }


    
}

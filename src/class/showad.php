<?php 
/* Import */
require_once __DIR__ . "/lib/db.php";

class Ad
{
    /* Propriétés */
    public string $title;
    public string $description;
    public float $beginprice;
    public float $reserveprice;
    public string $enddate;
    public string $model;
    public string $brand;
    public string $power;
    public int $year;
    public int $id_user;

    /* Constructeur */
    public function __construct($title, $description, $beginprice, $reserveprice, $enddate, $model, $brand, $power, $year, $id_user) {

        $this->title = $title;
        $this->description = $description;
        $this->beginprice = $beginprice;
        $this->reserveprice = $reserveprice;
        $this->enddate = $enddate;
        $this->model = $model;
        $this->brand = $brand;
        $this->power = $power;
        $this->year = $year;
        $this->id_user = $id_user;
    }

    /* Sauvegarde de l'objet annonce dans la base de données */
    public function save_ad(): string
    {
        global $dbh;
        $query = $dbh->prepare("INSERT INTO ad (title, description, beginprice, reserveprice, enddate, model, brand, power, year, id_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
        return $query->execute([$this->title, $this->description, $this->beginprice, $this->reserveprice, $this->enddate, $this->model, $this->brand, $this->power, $this->year, $this->id_user]);
    }

    /* Méthode statique de récupération d'une annonce dans la base de donnée
     * par son id. Cette méthode retourne une instance la classe ad */
    public static function getAdById(int $id): Ad | null
    {
        global $dbh;
        $query = $dbh->prepare("SELECT * FROM ad WHERE id = ?;");
        $query->execute([$id]);
        $ad_data = $query->fetch(PDO::FETCH_ASSOC);

        if ($ad_data != false) {
            $ad = new Ad($ad_data["title"], $ad_data["description"], $ad_data["beginprice"], $ad_data["reserveprice"], $ad_data["enddate"], $ad_data["model"], $ad_data["brand"], $ad_data["power"], $ad_data["year"], $ad_data["user"]);
            $ad->id = $ad_data["id"];
            return $ad;
        } else {
            return null;
        }
    }
}
?>
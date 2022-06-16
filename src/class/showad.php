<?php session_start();

/* Import */
require_once __DIR__ . "/lib/db.php";

/* Si le verbe HTTP est différent de POST */
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    die();
}


/* Préparation de la requête */
$queryads = $dbh->prepare("SELECT * FROM ad ");
$resultads = $query->execute();
$ads = $query->fetchall();

/* Récupération des données du formulaire */
$title = htmlspecialchars($_POST["title"]);
$description = htmlspecialchars($_POST["description"]);
$beginprice = htmlspecialchars($_POST["beginprice"]);
$reserveprice = htmlspecialchars($_POST["reserveprice"]);
$enddate = htmlspecialchars($_POST["enddate"]);
$model = htmlspecialchars($_POST["model"]);
$brand = htmlspecialchars($_POST["brand"]);
$power = htmlspecialchars($_POST["power"]);
$year = htmlspecialchars($_POST["year"]);
$id_user = htmlspecialchars($_POST["id_user"]);

class showad
{
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


    public function __construct(
        $title,
        $description,
        $beginprice,
        $reserveprice,
        $enddate,
        $model,
        $brand,
        $power,
        $year,
        $id_user
    ) {

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
    public function showads()
    {


        foreach ($ads as  $ad) { ?>
            "<tr>
                <td><?= $title ?></td>
                <td><?= $description ?></td>
                <td><?= $beginprice ?></td>
                <td><?= $reserveprice ?></td>
                <td><?= $enddate ?></td>
                <td><?= $model ?></td>
                <td><?= $brand ?></td>
                <td><?= $power ?></td>
                <td><?= $year ?></td>
                <td>
                    <form action="detail-ad.php" method="post">
                        <input type="hidden" name="id" value="<?= $ad["id"] ?>">
                        <input type="submit" value="detail ad">
                    </form>
                </td>
            </tr>"
<?php }
    }
} ?>
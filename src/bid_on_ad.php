<?php function Afficher_encherir($a)
{ ?>
    <form action="bid_on_ad_result.php" method="POST">
        <input type="number" name="price" step="100">
        <input type="hidden" name="id_ad" value="<?= $a ?>">

        <input type="submit" value="ENCHERIR">
    </form>
<?php } ?>
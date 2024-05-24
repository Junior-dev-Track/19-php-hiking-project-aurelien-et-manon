<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


?>

<h2> <?= $product['name'] ?> </h2>
<p> <?= $product['description'] ?></p>
<h4>Price: $<?= $product['duration'] ?></h4>
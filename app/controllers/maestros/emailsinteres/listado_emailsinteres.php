<?php

$sql_emailsinteres = "SELECT * FROM `emailsinteres`";
$query_emailsinteres = $pdo->prepare($sql_emailsinteres);
$query_emailsinteres->execute();
$emailsinteres_datos = $query_emailsinteres->fetchAll(PDO::FETCH_ASSOC);

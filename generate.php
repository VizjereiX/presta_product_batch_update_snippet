<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db = new mysqli("localhost","root","","products");

if ($db->connect_error) {
           die("Connection failed: " . $db->connect_error);
}

$productInsert = $db->prepare("INSERT INTO ps_product VALUES (?, ?)");
$stockInsert = $db->prepare("INSERT INTO ps_stock_available VALUES (?, ?)");

$price = 0;
$id = 0;
$ref = "ABC";

$productInsert->bind_param("is", $id, $ref);
$stockInsert->bind_param("ii", $id, $price);

$handle = fopen("/var/lib/mysql-files/quantities.csv", "w+");

for ($i = 1; $i <= 100000; $i++) {
        $id = $i;
        $price = $i * 10;
        $ref = "product_" . $i;
        $newPrice = $price + 10;
        $productInsert->execute();
        if (mt_rand(1,100) < 10) {
                $stockInsert->execute();
        }
        if (mt_rand(1, 100) < 70) {
                fputcsv($handle, [$ref, $newPrice]);
        }
}
fclose($handle);
$db->close();

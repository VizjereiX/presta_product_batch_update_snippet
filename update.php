<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db = new mysqli("localhost","root","","products");

if ($db->connect_error) {
           die("Connection failed: " . $db->connect_error);
}

$db->query("CREATE TEMPORARY TABLE prices_tmp (reference VARCHAR(100), quantity INT)");
$db->query("LOAD DATA INFILE '/var/lib/mysql-files/quantities.csv' INTO TABLE prices_tmp FIELDS TERMINATED BY ','");
$db->query("UPDATE ps_stock_available s, ps_product p, prices_tmp t SET s.quantity = t.quantity  WHERE s.id_product = p.id_product AND p.reference = t.reference");

$db->close();

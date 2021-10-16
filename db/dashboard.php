<?php
include "dbconfig.php";
// $query="SELECT sum(amount),e.cat_id,c.cat_name from expenses as e
// LEFT JOIN category as c
// ON e.cat_id = c.id
// WHERE e.cat_id=c.id && e.user_id='".$_SESSION["user"]."'
// GROUP BY e.cat_id";
$userid=$_SESSION['user'];
$query = "SELECT sum(amount),e.cat_id,c.cat_name FROM category as c
   left JOIN expenses as e ON c.id = e.cat_id where c.user_id='$userid' GROUP BY c.id";
$data = mysqli_query($conn, $query);
$total = 0;
$valuesarray = array();
$percentagearray = array();
while ($row = mysqli_fetch_array($data)) {
    $total = $total + $row['sum(amount)'];
    if($row['sum(amount)']==NULL){
        $row['sum(amount)']=0;
    }
    $valuesarray[$row["cat_name"]] = $row['sum(amount)'];
}
foreach ($valuesarray as $key => $val) {
    $per = round(($val / $total) * 100, 2);
    $percentagearray[$key] = $per;
}
//!valuesarray consist the amount in ruppes spent in categories
//! percentagearray consists percenttage of amount spent in categories
$percentagearrayjson = json_encode($percentagearray);
$valuesarrayjson = json_encode($valuesarray);
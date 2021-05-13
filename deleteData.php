<?php
include_once('conn.php');
$date = date('Y-m-d');
$limit = date('Y-m-d', strtotime("-5 years", strtotime($date)));
$query = "SELECT * FROM user u INNER JOIN accdata a ON u.id=a.userId INNER JOIN payment p ON p.accdata_id=a.data_id WHERE a.is_left <= :limitDate";
$data = [
     ':limitDate' => $limit
];
$stm = $conn->prepare($query);
$stm->execute($data);
$result=$stm->fetchAll();

     // var_dump($result); exit;
if($result == true) {
     $query1 = "DELETE FROM user u INNER JOIN accdata a ON u.id=a.userId INNER JOIN payment p ON p.accdata_id=a.data_id WHERE a.is_left <= :limitDate";
     $d = [
     ':limitDate' => $limit
     ];
     $statement=$conn->prepare($query1);
     $statement->execute($d);
     $res=$statement->fetch();
     var_dump($res); exit;
}
// $query1 = "DELETE * FROM user u INNER JOIN accdata a ON u.id=a.userId INNER JOIN payment p ON p.accdata_id=a.data_id WHERE a.is_left <= :limitDate";
// $data = [
//      ':limitDate' => $limit
// ];
// $statement=$conn->prepare($query1);
// $statement->execute($data);
// $res=$statement->fetch();
//      var_dump($res); exit;

// }

?>

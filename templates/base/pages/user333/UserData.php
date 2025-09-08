<?php

require_once '../../inc/connexion.inc.php';
$sql = "SELECT * FROM user";
$results = $conn->query($sql);
$row = $results->fetch_all(MYSQLI_ASSOC);
$results->free_result();
$conn->close();
echo json_encode($row);

?>



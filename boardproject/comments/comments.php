<?php




$idx = $_GET['view'];




$sql = "SELECT * FROM comments WHERE idx = :idx ORDER BY COALESCE(comg, cidx)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":idx", $idx);
$stmt->execute();
$result = $stmt->fetchAll();


?>
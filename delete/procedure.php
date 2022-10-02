<?php 

    require "../db.php";    
    if (isset($_GET["id"])) {
        $sql = "UPDATE report SET deleted_at = now() where id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            "id" => $_GET["id"]
        ]);
        header("Location: ".$_GET["redirectTo"]);
    } else {
        header("Location: /2/nemocnice/");
    }
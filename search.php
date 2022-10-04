<?php 

    require "db.php";

    if (isset($_GET["search"])) {
    $sqlReport = "SELECT * from report r 
    WHERE (
        note is like '%' :search '%'
    )";
    $sqlProcedure = "SELECT * from procedures 
    WHERE (
        title is like '%' :search '%'
    )
    "
    };

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výsledky hledání: </title>
</head>
<body>
    
</body>
</html>
<?php

    require "../db.php";

    if(isset($_POST) && !empty($_POST)) {
        $SQL = "INSERT INTO patient (name, surname) VALUES (:name, :surname)";
        $stmt = $conn -> prepare($SQL);
        $stmt -> execute([
            "name" => $_POST["name"],
            "surname" => $_POST["surname"]
        ]);
        $id = $conn -> lastInsertId();
        header("Location: /2/nemocnice/detail/patient.php?id=".$id);
    }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../output.css" rel="stylesheet">
    <title>Přidat pacienta</title>
</head>
<body>
    <div class="w-[80%] mx-auto mt-4">
        <a href="/2/nemocnice/" class=""><button class="block mb-5 uppercase shadow bg-indigo-800 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">Domů</button></a>
        <h1 class="text-3xl text-center">Nový pacient</h1>
       <form action="" method="post" class="flex flex-col items-center w-full">
        <label class="flex flex-col p-2" for="">Příjmení<input class="input border border-gray-400 appearance-none rounded w-full p-4 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600" type="text" name="surname" id=""></label>
        <label class="flex flex-col p-2" for="">Jméno<input class="input border border-gray-400 appearance-none rounded w-full p-4 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600" type="text" name="name" id=""></label>
        <button type="submit"  class="mt-2 uppercase mx-auto shadow bg-indigo-800 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">Přidat</button>
       </form> 
    </div>    
</body>
</html>
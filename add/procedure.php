
<?php

    require "../db.php";

    if(isset($_POST) && !empty($_POST)) {
        $SQL = "INSERT INTO report (patient_id, procedure_id, date, note) VALUES (:patientId, :procedureId, now(), :note)";
        $stmt = $conn -> prepare($SQL);
        $stmt -> execute([
            "patientId" => $_POST["patient"],
            "procedureId" => $_POST["procedure"],
            "note" => $_POST["note"]
        ]);

        header("Location: /2/nemocnice/detail/patient.php?id=".$_POST["patient"]);
    }

    $sql = "SELECT * from patient";
    $stmt = $conn->query($sql);
    $patients = $stmt->fetchAll();

    $sql = "SELECT * from procedures";
    $stmt = $conn->query($sql);
    $procedures = $stmt->fetchAll();


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../output.css" rel="stylesheet">
    <title>Přidat zdravotní úkon</title>
</head>
<body>
    <div class="w-[50%] mx-auto mt-4">
        <a href="/2/nemocnice/" class=""><button class="block mb-5 uppercase shadow bg-indigo-800 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">Domů</button></a>
        <h1 class="text-3xl text-center">Nový zdravotní úkon</h1>
       <form action="" method="post" class="flex flex-col items-center w-full">
        <label class="flex flex-col p-2 w-full" for="">Pacient
        <select name="patient" id="" class="bg-gray-50 border border-gray-300 text-gray-900 w-full p-4 text-sm rounded-lg">
          <option value="" selected hidden>--Vyberte Pacienta--</option>
          <?php foreach($patients as $p): ?>
            <option value="<?= $p["id"] ?>" <?= isset($_GET["id"]) && $_GET["id"] == $p["id"] ? "selected" : "" ?> ><?= $p["name"] ?> <?= $p["surname"] ?></option>
          <?php endforeach; ?>
        </select></label>
        <label class="flex flex-col p-2 w-full" for="">Výkon
        <select name="procedure" id="" class="bg-gray-50 border border-gray-300 text-gray-900 w-full p-4 text-sm rounded-lg">
          <option value="" selected hidden>--Vyberte Výkon--</option>
          <?php foreach($procedures as $p): ?>
            <option value="<?= $p["id"] ?>"><?= $p["number"] ?> <?= $p["title"] ?></option>
          <?php endforeach; ?>
        </select></label>
        <label for="" class="flex flex-col p-2 w-full">Doplňující informace: 
            <textarea name="note" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Your message..."></textarea>

        </label>
        <button type="submit"  class="mt-2 uppercase mx-auto shadow bg-indigo-800 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">Přidat</button>
       </form> 
    </div>    
</body>
</html>
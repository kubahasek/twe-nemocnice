<?php

  require "../db.php";

  if(isset($_GET["id"])) {      

    // Výkony na pacientovi
    $sql = "SELECT r.id as reportId, r.date, pr.number as procedureNum, pr.id as procedureId, pr.title as procedureName, r.note as procedureNote, pr.price as procedurePrice from report r 
    inner join procedures pr on r.procedure_id = pr.id
    inner join patient p on p.id = r.patient_id
    where p.id = :patientId and r.deleted_at is null
    ORDER BY r.date";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
      "patientId" => $_GET["id"]
    ]);
    $data = $stmt->fetchAll();

    // Data pacienta
    $sql = "SELECT * from patient where id = :patientId";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
      "patientId" => $_GET["id"]
    ]);
    $patient = $stmt->fetch();

    // Celková cena za výkony
    $sql = "SELECT sum(pr.price) as totalPrice from report r 
    inner join procedures pr on r.procedure_id = pr.id
    inner join patient p on p.id = r.patient_id
    where p.id = :patientId";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
      "patientId" => $_GET["id"]
    ]);
    $totalPrice = $stmt->fetch()["totalPrice"];
  };

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <title>Pacient <?= $patient["name"]." ".$patient["surname"] ?></title>
</head>
<body>
  <div class="w-[80%] mx-auto mt-5">
    <div class="flex flex-row justify-between">
      <div>
        <h1 class="text-3xl mb-2">Pacient <?= $patient["name"]." ".$patient["surname"] ?></h1>
        <a href="/2/nemocnice/add/procedure.php?id=<?= $patient["id"] ?>" class=""><button class="block uppercase shadow bg-indigo-800 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">Přidat zdravotní úkon</button></a>
      </div>
      <div class="border p-3 rounded border-gray-500">
        <h1 class="text-xl font-bold">Celková cena za výkony</h1>
        <p class="text-lg text-center"><?= number_format($totalPrice, 0, ",", " ") ?> Kč</p>
      </div>
    </div>
  <div class="mt-5">
    <h1 class="text-3xl">Poslední provedené výkony</h1>
    <table class="w-full border border-gray-500 text-left mt-3">
      <tr class="bg-gray-400">
        <th class="border border-gray-500 p-2">Datum a Čas</th>
        <th class="border border-gray-500 p-2">Úkon</th>
        <th class="border border-gray-500 p-2">Cena</th>
        <th class="border border-gray-500 p-2">Akce</th>
      </tr>
      <?php foreach($data as $d): ?>
        <tr class="border border-gray-500">
          <td class="border border-gray-500 p-2"><?= $d["date"] ?></td>
          <td class="border border-gray-500 p-2"><a href="/2/nemocnice/detail/procedure.php?id=<?= $d["procedureId"] ?>" class="text-blue-500 underline"><?= $d["procedureNum"] ?></a> <?= $d["procedureName"] ?><br>Info: <?= $d["procedureNote"] ?></td>
          <td class="border border-gray-500 p-2"><?= number_format($d["procedurePrice"], 0, ",", " ") ?> Kč</td>
          <td class="border border-gray-500 p-2"><a class="text-blue-500 underline" href="/2/nemocnice/delete/procedure.php?id=<?= $d["reportId"] ?>&redirectTo=/2/nemocnice/detail/patient.php?id=<?= $patient["id"] ?>">Smazat</a></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

  </div>   
</body>
</html>
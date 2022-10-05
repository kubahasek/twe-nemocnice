<?php 

    require "db.php";

    if (isset($_GET["search"])) {
    $sqlReport = "SELECT pa.name, pa.surname, r.note, p.id, p.number, p.title from report r INNER JOIN procedures p on r.procedure_id = p.id INNER JOIN patient pa on pa.id = r.patient_id 
    WHERE (
        r.note  like '%' :search '%' or
        pa.name like  '%' :search '%' or
        pa.surname like '%' :search '%'
    )
    group by p.number
    ";

    $sqlProcedure = "SELECT * from procedures 
    WHERE (
        title like '%' :search '%'
    )
    ";

    $sqlPatient = "SELECT * from patient 
    WHERE (
        name like '%' :search '%' or
        surname like '%' :search '%'
    )";

    $stmt = $conn -> prepare($sqlReport);
    $stmt -> execute([
        "search" => $_GET["search"]
    ]);
    $reports = $stmt -> fetchAll();

    $stmt = $conn -> prepare($sqlProcedure);
    $stmt -> execute([
        "search" => $_GET["search"]
    ]);
    $procedures = $stmt -> fetchAll();

    $stmt = $conn -> prepare($sqlPatient);
    $stmt -> execute([
        "search" => $_GET["search"]
    ]);
    $patients = $stmt -> fetchAll();
    };

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výsledky hledání: </title>
    <link rel="stylesheet" href="output.css">
</head>
<body>
    <div class="w-[80%] mx-auto mt-5">
      <?php if(count($patients) > 0): ?>
      <table class="w-full border border-gray-500 text-left mt-3">
        <tr class="bg-gray-400">
          <th class="border border-gray-500 p-2">Jméno</th>
          <th class="border border-gray-500 p-2">Odkaz</th>
        </tr>
        <?php foreach($patients as $p): ?>
          <tr class="border border-gray-500">
            <td class="border border-gray-500 p-2"><?= $p["name"] ?> <?= $p["surname"] ?></td>
            <td class="border border-gray-500 p-2"><a href="/2/nemocnice/detail/patient.php?id=<?= $p["id"] ?>" class="text-blue-500 underline">LINK</a></td>
          </tr>
        <?php endforeach; ?>
      </table>
      <?php endif; ?>
  
      <?php if(count($reports) > 0): ?>
      <table class="w-full border border-gray-500 text-left mt-3">
        <tr class="bg-gray-400">
          <th class="border border-gray-500 p-2">Procedura</th>
          <th class="border border-gray-500 p-2">Odkaz</th>
        </tr>
        <?php foreach($reports as $r): ?>
          <tr class="border border-gray-500">
            <td class="border border-gray-500 p-2"><?= $r["number"] ?> <?= $r["title"] ?></td>
            <td class="border border-gray-500 p-2"><a href="/2/nemocnice/detail/procedure.php?id=<?= $r["id"] ?>" class="text-blue-500 underline">LINK</a></td>
          </tr>
        <?php endforeach; ?>
      </table>
      <?php endif; ?>
  
      <?php if(count($procedures) > 0): ?>
      <table class="w-full border border-gray-500 text-left mt-3">
        <tr class="bg-gray-400">
          <th class="border border-gray-500 p-2">Procedura</th>
          <th class="border border-gray-500 p-2">Odkaz</th>
        </tr>
        <?php foreach($procedures as $p): ?>
          <tr class="border border-gray-500">
            <td class="border border-gray-500 p-2"><?= $p["number"] ?> <?= $p["title"] ?></td>
            <td class="border border-gray-500 p-2"><a href="/2/nemocnice/detail/procedure.php?id=<?= $p["id"] ?>" class="text-blue-500 underline">LINK</a></td>
          </tr>
        <?php endforeach; ?>
      </table>
      <?php endif; ?>
    </div>
</body>
</html>
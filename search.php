<?php 

    require "db.php";

    if (isset($_GET["search"])) {
    $sqlReport = "SELECT * from report r 
    WHERE (
        note is like '%' :search '%'
    )
    INNER JOIN procedures p on r.procedure_id = p.id";

    $sqlProcedure = "SELECT * from procedures 
    WHERE (
        title is like '%' :search '%'
    )
    ";

    $sqlPatient = "SELECT * from patient 
    WHERE (
        name is like '%' :search '%' or
        surname is like '%' :search '%'
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
</head>
<body>
    <?php if(len($patients) > 0): ?>
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

    <?php if(len($reports) > 0): ?>
    <table class="w-full border border-gray-500 text-left mt-3">
      <tr class="bg-gray-400">
        <th class="border border-gray-500 p-2">Procedura</th>
        <th class="border border-gray-500 p-2">Poznámka</th>
        <th class="border border-gray-500 p-2">Odkaz</th>
      </tr>
      <?php foreach($reports as $r): ?>
        <tr class="border border-gray-500">
          <td class="border border-gray-500 p-2"><?= $p["number"] ?> <?= $p["title"] ?></td>
          <td class="border border-gray-500 p-2"><?= $p["note"] ?></td>
          <td class="border border-gray-500 p-2"><a href="/2/nemocnice/detail/procedure.php?id=<?= $p["id"] ?>" class="text-blue-500 underline">LINK</a></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <?php if(len($procedures) > 0): ?>
    <table class="w-full border border-gray-500 text-left mt-3">
      <tr class="bg-gray-400">
        <th class="border border-gray-500 p-2">Číslo</th>
        <th class="border border-gray-500 p-2">Procedura</th>
        <th class="border border-gray-500 p-2">Odkaz</th>
      </tr>
      <?php foreach($reports as $r): ?>
        <tr class="border border-gray-500">
          <td class="border border-gray-500 p-2"><?= $p["number"] ?> <?= $p["title"] ?></td>
          <td class="border border-gray-500 p-2"><?= $p["note"] ?></td>
          <td class="border border-gray-500 p-2"><a href="/2/nemocnice/detail/procedure.php?id=<?= $p["id"] ?>" class="text-blue-500 underline">LINK</a></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <?php endif; ?>
</body>
</html>
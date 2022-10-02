  <?php

    if(isset($_POST) && !empty($_POST)){
      $id = $_POST["patient"];
      header("Location: patient.php?id=".$id);
    };

  ?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="output.css" rel="stylesheet">
</head>
<?php 

  require "db.php";

  $sql = "SELECT concat(p.name,' ', p.surname) as name, p.id as patientId, r.date, pr.number as procedureNum, pr.id as procedureId, pr.title as procedureName from report r 
  inner join procedures pr on r.procedure_id = pr.id
  inner join patient p on p.id = r.patient_id
  WHERE r.deleted_at is null
  ORDER BY r.date
  LIMIT 5";
  $stmt = $conn->query($sql);
  $data = $stmt -> fetchAll();
  
  $sql = "SELECT * from patient";
  $stmt = $conn->query($sql);
  $patients = $stmt -> fetchAll();

?>
<body>
 <div class="w-[80%] mx-auto mt-5">
  <div class="flex flex-row justify-between">
    <div>
      <h1 class="text-3xl">Lékařské záznamy</h1>
      <div class="flex flex-row gap-3 mt-3">
        <a href="add/procedure.php" class=""><button class="block uppercase shadow bg-indigo-800 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">Přidat zdravotní úkon</button></a>
        <a href="add/patient.php" class="block"><button class="block uppercase shadow bg-indigo-800 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">Přidat pacienta</button></a>
      </div>
    </div>
    <div class="border p-3 rounded border-gray-500">
      <h1 class="text-3xl text-right mb-4">Vyber pacienta</h1>
      <form action="" method="post" class="flex flex-row gap-5">
        <select name="patient" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg">
          <option value="" selected hidden>--Vyberte Pacienta--</option>
          <?php foreach($patients as $p): ?>
            <option value="<?= $p["id"] ?>"><?= $p["name"] ?> <?= $p["surname"] ?></option>
          <?php endforeach; ?>
        </select>
          <button type="submit"  class="uppercase mx-auto shadow bg-indigo-800 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">Vybrat</button>
      </form>
    </div>

  </div>
  <div class="mt-5">
    <h1 class="text-3xl">Poslední provedené výkony</h1>
    <table class="w-full border border-gray-500 text-left mt-3">
      <tr class="bg-gray-400">
        <th class="border border-gray-500 p-2">Datum a Čas</th>
        <th class="border border-gray-500 p-2">Pacient</th>
        <th class="border border-gray-500 p-2">Úkon</th>
      </tr>
      <?php foreach($data as $d): ?>
        <tr class="border border-gray-500">
          <td class="border border-gray-500 p-2"><?= $d["date"] ?></td>
          <td class="border border-gray-500 p-2"><a href="detail/patient.php?id=<?= $d["patientId"] ?>" class="text-blue-500 underline"><?= $d["name"] ?></a></td>
          <td class="border border-gray-500 p-2"><a href="detail/procedure.php?id=<?= $d["procedureId"] ?>" class="text-blue-500 underline"><?= $d["procedureNum"] ?></a> <?= $d["procedureName"] ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
 </div>
</body>
</html>
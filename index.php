<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <title>Laporan Corona</title>

  <link href="asset/css/bootstrap.css" rel="stylesheet">
  <link href="asset/css/jasny-bootstrap.css" rel="stylesheet">
  <link href="asset/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="asset/css/bootstrap.min.css">
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1"></head>
<br><br><br>
<body>
  <?php
  $urlpositif="https://api.kawalcorona.com/positif/";
  $urlsembuh="https://api.kawalcorona.com/sembuh/";
  $urlmeninggal="https://api.kawalcorona.com/meninggal/";
  $ambilpositif=json_decode(file_get_contents($urlpositif),true);
  $ambilsembuh=json_decode(file_get_contents($urlsembuh),true);
  $ambilmeninggal=json_decode(file_get_contents($urlmeninggal),true);
  ?>
<div class="container">
  <h1>corona live data</h1>
  <br>
  <div class="panel panel-success text-center">
    <div class="panel-heading">Orang yang sembuh</div>
    <div class="panel-body"><b><?php echo $ambilsembuh['value']; ?></b></div>
  </div>
  <div class="panel panel-warning text-center">
    <div class="panel-heading">Orang yang positif</div>
    <div class="panel-body"><b><?php echo $ambilpositif['value'] ?></b></div>
  </div>
  <div class="panel panel-danger text-center">
    <div class="panel-heading">Orang yang meninggal</div>
    <div class="panel-body"><b><?php echo $ambilmeninggal['value'] ?></b></div>
  </div>
  <br>
  <br><br><br>
  <label for="input">Cari negara</label>
<input type='text' id='input' onkeyup='searchTable()' placeholder="Cari berdasarkan negara" class="form-control" width="10px">
<br>
<table class="table table-boarder">
  <thead>
    <tr>
      <th>No</th>
      <th>Negara</th>
      <th>Positif</th>
      <th>Meninggal</th>
      <th>Pulih</th>
    </tr>
  </thead>
<?php
$url="https://api.kawalcorona.com/";
$req=file_get_contents($url);
$get_json=json_decode($req,true);
$nomer=1;
for($i=0;$i<count($get_json);$i++){
  ?>
  <?php
  echo "<tr><td>".$nomer++."</td>";
  echo "<td>".$get_json[$i]['attributes']['Country_Region']."</td>";
  echo "<td>".$get_json[$i]['attributes']['Confirmed']."</td>";
  echo "<td>".$get_json[$i]['attributes']['Deaths']."</td>";
  echo "<td>".$get_json[$i]['attributes']['Recovered']."</td></tr>";
  ?>
  <?php
}
?>
</table>
</div>
</body>

    <script src="asset/js/jquery-3.1.1.min.js"></script>
    <script src="asset/js/jquery.easing.1.3.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>
    <script src="asset/js/script.js"></script>
    <script>
      function searchTable() {
          var input;
          var saring;
          var status; 
          var tbody; 
          var tr; 
          var td;
          var i; 
          var j;
          input = document.getElementById("input");
          saring = input.value.toUpperCase();
          tbody = document.getElementsByTagName("tbody")[0];;
          tr = tbody.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
              td = tr[i].getElementsByTagName("td");
              for (j = 0; j < td.length; j++) {
                  if (td[j].innerHTML.toUpperCase().indexOf(saring) > -1) {
                      status = true;
                  }
              }
              if (status) {
                  tr[i].style.display = "";
                  status = false;
              } else {
                  tr[i].style.display = "none";
              }
          }
      }
    </script>
    <br><br>
    <style>
      .hasu{
        color:black;
        opacity: 0.5;
        text-align: center;
      }
    </style>
    <div class="hasu">Data from <a href="https://kawalcorona.com">kawalcorona.com</a></div>
    <br><br><br>
</html>

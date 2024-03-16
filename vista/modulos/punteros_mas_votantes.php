<?php

$item = null;
$valor = null;
$sede = $_POST['sede'] ?? 'caacupe';
$productos = ControladorPuntero::ctrMostrarPunterosUnicos($item, $valor, $sede);

?>

<!--=====================================
PRODUCTOS MÁS VENDIDOS
======================================-->

<!-- <div class="graficos">

  <div class="box-header with-border">
    <hr>
    <h3 class="box-title">Punteros con más votantes</h3>

  </div>

  <div class="">


    <div class="chart-responsive">

      <canvas id="pieChart"></canvas>

    </div>

  </div>


</div> -->
<h3 class="box-title">Punteros con más votos</h3>
<div>
  <canvas id="myChart"></canvas>
</div>

<div class="box-footer no-padding punteroVotante p-3">
  <hr>
  <br>
  <h3 class="box-title">Tabla de punteros y sus votantes</h3>
  <br>
  <table id="example1" class="table table-bordered table-striped tablas text-center">
    <thead>
      <tr>
        <th>Puntero</th>
        <th>Ciudad Puntero</th>
        <th>Cedula Puntero</th>
        <th>Votantes</th>
        <th>Paso por pc</th>
        <!-- <th>Porcentaje</th> -->
        <th>Votos</th>
        <th>Ya Votaron</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $labels = [];
      $dataset = [];
      foreach ($productos as $key => $value) {
        // $votos = ControladorPuntero::ctrMostrarCantidadVotante($value["id_lider"]);
        // $ya_voto = ModeloPuntero::mdlCantidadVotoPorPuntero("puntero", $value["id_lider"]);
        // $ya_paso_pc = ModeloPuntero::mdlCantidadPcPorPuntero("puntero", $value["id_lider"]);
        // $porcentaje = ceil(intval($votos[0]) * 100 / intval($total["total"]));

        $votos = $value["total_votantes"];
        $ya_voto = $value["ya_voto"];
        $ya_paso_pc = $value["paso_pc"];
        $labels [] = $value['nombre'].' '.$value["apellido"];
        $dataset [] = $ya_voto;

        echo '<tr>';
        echo '<td>' . $value["nombre"] . ' ' . $value["apellido"] . ' (' . $value["cedula"] . ')' . '</td>';
        echo '<td>' . $value["ciudad"] . '</td>';
        echo '<td>' . $value["cedula"] . '</td>';
        echo '<td>' . $votos . '</td>';
        echo '<td>' . $ya_paso_pc . '</td>';
        // echo '<td>' . $porcentaje . '%</td>';
        echo '<td>';
        echo '<span class="bg-' . (($ya_voto == 0) ? 'red' : (($ya_voto == $votos) ? 'green' : 'yellow')) . ' text-white votoPuntero p-2">' . $ya_voto . '</span>';
        echo '</td>';
        echo '<td>';
        echo '<span class="bg-' . (($ya_voto == 0) ? 'red' : (($ya_voto == $votos) ? 'green' : 'yellow')) . ' text-white votoPuntero p-2">' . $ya_voto . '</span>';
        echo '</td>';
        echo '</tr>';
      }
      ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
  // Datos de ejemplo en PHP
  $punteroschart = json_encode($labels);
  $data = json_encode($dataset);
?>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo $punteroschart; ?>,
      datasets: [{
        label: 'Ya votaron',
        data: <?php echo $data; ?>,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
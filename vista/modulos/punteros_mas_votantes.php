<?php

$item = null;
$valor = null;
$sede = $_POST['sede'] ?? 'caacupe';
$productos = ControladorPuntero::ctrMostrarPunterosUnicos($item, $valor, $sede);
//return var_dump($productos);
$colores = array("red", "green", "yellow", "aqua", "purple", "blue", "cyan", "magenta", "orange", "gold");
$colores = [
  'orange',
  'yellow',
  'green',
  'blue',
  'purple',
  'brown',
  'black',
  'grey',
  'indigo',
  'pink',
  'light blue',
  'pale blue',
  'sky blue',
  'dark blue',
  'deep blue',
  'navy blue',
  'Brightblue',
  'olive green',
  'jet black',
  'apple green',
  'apricot',
  'aquamarine',
  'avocado',
  'beige',
  'cerise',
  'cream',
  'crimson',
  'dusty-pink',
  'emerald',
  'fuchsia',
  'golden',
  'ivory',
  'jade',
  'khaki',
  'lavender',
  'lemon',
  'lilac',
  'lime',
  'magenta',
  'mustard',
  'oatmeal',
  'ochre',
  'off-white',
  'peach',
  'plum',
  'russet',
  'salmon',
  'sienna',
  'silver',
  'tan',
  'terra cotta',
  'topaz',
  'tortoiseshell',
  'turquoise',
  'food colouring',
  'violet'
];

$total = ControladorPuntero::ctrMostrarSumaPuntero();


?>

<!--=====================================
PRODUCTOS MÁS VENDIDOS
======================================-->

<div class="graficos">

  <div class="box-header with-border">
    <hr>
    <h3 class="box-title">Punteros con más votantes</h3>

  </div>

  <div class="">


    <div class="chart-responsive">

      <canvas id="pieChart"></canvas>

    </div>

  </div>

  <!-- <div class="box-footer no-padding punteroVotante p-3">

        <ul class="">

            <?php


            $votos = 0;

            foreach ($productos as $key => $value) {
              //var_dump($key);

              $votos = ControladorPuntero::ctrMostrarCantidadVotante($value["id_lider"]);

              $ya_voto = ModeloPuntero::mdlCantidadVotoPorPuntero("puntero", $value["id_lider"]);

              if ($votos[0] == $ya_voto["total"]) {

                echo '
          				<li>
						 
    						 <p>' . $value["nombre"] . '<span class="pull-right text-' . $colores[mt_rand(0, 55)] . '">   
    						 ' . ceil(intval($votos[0]) * 100 / intval($total["total"])) . '% ,Votantes: <strong>' . $votos[0] . '</strong>, <span class="bg-green text-white votoPuntero p-2">de estos ya votaron: ' . $ya_voto["total"] . '</span></span>
    			       		 </p>
                 

      					</li> 
      					
      					';
              } elseif ($ya_voto["total"] <= $votos[0] and $ya_voto["total"] > 0) {

                echo '
          				<li>
						 
    						 <p>' . $value["nombre"] . '<span class="pull-right text-' . $colores[mt_rand(0, 55)] . '">   
    						 ' . ceil(intval($votos[0]) * 100 / intval($total["total"])) . '% ,Votantes: <strong>' . $votos[0] . '</strong>, <span class="bg-yellow text-white votoPuntero p-2"> de estos ya votaron: ' . $ya_voto["total"] . '<span> </span>
    			       		 </p>
                 

      					</li> 
      					
      					';
              } elseif ($ya_voto["total"] == 0) {

                echo '
          				<li>
						 
    						 <p>' . $value["nombre"] . '<span class="pull-right text-' . $colores[mt_rand(0, 55)] . '">   
    						 ' . ceil(intval($votos[0]) * 100 / intval($total["total"])) . '% ,Votantes: <strong>' . $votos[0] . '</strong>,<span class="bg-red text-white votoPuntero p-2"> de estos ya votaron: ' . $ya_voto["total"] . '<span> </span>
    			       		 </p>
                 

      					</li> 
      					
      					';
              }
            }

            ?>


        </ul>

    </div> -->


  <div class="box-footer no-padding punteroVotante p-3">
    <hr>
    <br>
    <h3 class="box-title">Tabla de punteros y sus votantes</h3>
    <br>
    <table id="example1" class="table table-bordered table-striped tablas text-center">
      <thead>
        <tr>
          <th>Puntero</th>
          <th>Votantes</th>
          <th>Paso por pc</th>
          <!-- <th>Porcentaje</th> -->
          <th>Votos</th>
          <th>Ya Votaron</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($productos as $key => $value) {
          $votos = ControladorPuntero::ctrMostrarCantidadVotante($value["id_lider"]);
          $ya_voto = ModeloPuntero::mdlCantidadVotoPorPuntero("puntero", $value["id_lider"]);
          $ya_paso_pc = ModeloPuntero::mdlCantidadPcPorPuntero("puntero", $value["id_lider"]);
          $porcentaje = ceil(intval($votos[0]) * 100 / intval($total["total"]));

          echo '<tr>';
          echo '<td>' . $value["nombre"] .' '.$value["apellido"] . '</td>';
          echo '<td>' . $votos[0] . '</td>';
          echo '<td>' . $ya_paso_pc["total"] . '</td>';
          // echo '<td>' . $porcentaje . '%</td>';
          echo '<td>';
          echo '<span class="bg-' . (($ya_voto["total"] == 0) ? 'red' : (($ya_voto["total"] == $votos[0]) ? 'green' : 'yellow')) . ' text-white votoPuntero p-2">' . $ya_voto["total"] . '</span>';
          echo '</td>';
          echo '<td>';
          echo '<span class="bg-' . (($ya_voto["total"] == 0) ? 'red' : (($ya_voto["total"] == $votos[0]) ? 'green' : 'yellow')) . ' text-white votoPuntero p-2">' . $ya_voto["total"] . '</span>';
          echo '</td>';
          echo '</tr>';
        }
        ?>
      </tbody>
    </table>
  </div>



</div>

<script>
  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  // var pieChartCanvas = $('#pieChart').get(0).getContext('2d');

  // var pieChart = new Chart(pieChartCanvas);
  // //console.log(pieChart);
  // var PieData = [

  //   <?php

        //   foreach ($productos as $key => $value) {


        //     $votos = ControladorPuntero::ctrMostrarCantidadVotante($value["id_lider"]);



        //     echo '
        //                {
        //                   value    : ' . ceil(intval($votos[0]) * 100 / intval($total["total"])) . ',
        //                   color    : "' . $colores[$key] . '",
        //                   highlight: "' . $colores[$key] . '",
        //                   label    : "% ' . $value["nombre"] . '"
        //                 },

        //             ';
        //   }


        //   
        ?>
  // ];
  // var pieOptions = {
  //   // Boolean - Whether we should show a stroke on each segment
  //   segmentShowStroke: true,
  //   // String - The colour of each segment stroke
  //   segmentStrokeColor: '#fff',
  //   // Number - The width of each segment stroke
  //   segmentStrokeWidth: 1,
  //   // Number - The percentage of the chart that we cut out of the middle
  //   percentageInnerCutout: 50, // This is 0 for Pie charts
  //   // Number - Amount of animation steps
  //   animationSteps: 100,
  //   // String - Animation easing effect
  //   animationEasing: 'easeOutBounce',
  //   // Boolean - Whether we animate the rotation of the Doughnut
  //   animateRotate: true,
  //   // Boolean - Whether we animate scaling the Doughnut from the centre
  //   animateScale: false,
  //   // Boolean - whether to make the chart responsive to window resizing
  //   responsive: true,
  //   // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
  //   maintainAspectRatio: false,
  //   // String - A legend template
  //   legendTemplate: '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
  //   // String - A tooltip template
  //   tooltipTemplate: '<%=value %> <%=label%>'
  // };
  // // Create pie or douhnut chart
  // // You can switch between pie and douhnut using the method below.
  // pieChart.Doughnut(PieData, pieOptions);

  // -----------------
  // - END PIE CHART -
  // -----------------

  $(document).ready(function() {

    var ya_voto = [

      <?php

      foreach ($productos as $key => $value) {

        $ya_voto = ModeloPuntero::mdlCantidadVotoPorPuntero("puntero", $value["id_lider"]);

        echo '
                  ' . $ya_voto["total"] . ',

                ';
      }


      ?>
    ];

    var nombres = [

      <?php

      foreach ($productos as $key => $value) {


        echo '
                      "' . $value["nombre"] . '",

                    ';
      }


      ?>
    ];
    console.log(nombres);
    var PieData = [

      <?php

      foreach ($productos as $key => $value) {


        $votos = ControladorPuntero::ctrMostrarCantidadVotante($value["id_lider"]);



        echo '
                    ' . $votos[0] . ',

                  ';
      }


      ?>
    ];
    console.log(PieData);
    // Obtiene el contexto del canvas
    var ctx = $('#pieChart').get(0).getContext('2d');

    // Crea el objeto Chart
    var data = {
      labels: nombres,
      datasets: [{
          label: "My First dataset",
          fillColor: "rgba(220,220,220,0.5)",
          strokeColor: "rgba(220,220,220,0.8)",
          highlightFill: "rgba(220,220,220,0.75)",
          highlightStroke: "rgba(220,220,220,1)",
          data: PieData
        },
        {
          label: "My Second dataset",
          fillColor: "rgba(151,187,205,0.5)",
          strokeColor: "rgba(151,187,205,0.8)",
          highlightFill: "rgba(151,187,205,0.75)",
          highlightStroke: "rgba(151,187,205,1)",
          data: ya_voto
        }
      ]
    };


    new Chart(ctx).Bar(data, {
      barShowStroke: false
    });
  });
</script>
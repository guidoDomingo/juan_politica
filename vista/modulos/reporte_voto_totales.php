<!--=====================================
PRODUCTOS MÁS VENDIDOS
======================================-->

<div class="box box-default">

  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div id="sedes_select_div" class="form-group">
          <form action="" method="POST">
            <select id="sedes_select" class="form-control" name="sede">
              <option selected value="ypa_itaugua" <?php if (isset($_POST['sede']) && $_POST['sede'] == 'ypa_itaugua') echo 'selected'; ?>>Votos en Itaugua</option>
              <option value="ypa_24_mayo" <?php if (isset($_POST['sede']) && $_POST['sede'] == 'ypa_24_mayo') echo 'selected'; ?>>Votos casa central( 24 de mayo)</option>
              <option value="ypa_hugua_hu" <?php if (isset($_POST['sede']) && $_POST['sede'] == 'ypa_hugua_hu') echo 'selected'; ?>>Votos hugua hu</option>
              <!-- Agrega más opciones según sea necesario -->
            </select>
            <input type="submit" class="btn btn-primary" value="Enviar">
          </form>
        </div>
      </div>
    </div>
  </div>




  <?php

  if (isset($_POST['sede'])) {

    $item = null;
    $valor = null;
    $sede = $_POST['sede'];
    //return var_dump($sede);
    $votantes = ControladorPuntero::ctrVotanteNombres($sede);

    $colores = array("red", "green", "yellow", "aqua", "purple", "blue", "cyan", "magenta", "orange", "gold");
    //voto total
    $total = ControladorPuntero::ctrPosibleVotanteTotal($sede);

    $votosTotales = ControladorPuntero::ctrVotanteTotal($sede);

    $faltaVotar = ModeloPuntero::mdlTodaviaNoVotaron("puntero", $sede);

    $votos_habilitados = ModeloPuntero::mdlTotalVotos($sede);
    //return var_dump($votos_habilitados['total']);

    $voto_pc = ModeloPuntero::mdlVotoPorPc($sede);

    $voto_ciudad = ModeloPuntero::mdlVotoPorCiudad($sede);
  } else {

    $votantes = ['total' => 0];

    $colores = array("red", "green", "yellow", "aqua", "purple", "blue", "cyan", "magenta", "orange", "gold");
    //voto total
    $total = ['total' => 0];

    $votosTotales = ['total' => 0];

    $votos_habilitados = ['total' => 0];
    //return var_dump($votos_habilitados['total']);

    $voto_pc = ['total' => 0];

    $voto_ciudad = [];


    $faltaVotar = ['total' => 0];
  }


  ?>



  <div class="box-header with-border">

    <h3 class="box-title">Tabla de mivimiento de votos</h3>

  </div>

  <div class="box-body">

    <div class="row">


      <!-- <div class="col-md-7">

	 			     <div class="chart-responsive">
	            
	             <canvas id="pieChart1" height="150"></canvas>
	          
	           </div>

	        </div> -->


      <div class="col-md-12">


        <table id="example2" class="table table-bordered table-striped tablas text-center">
          <thead>
            <tr>
              <th>Total de votantes</th>
              <th>Total de participación</th>
              <th>Total que pasaron por pc</th>
              <th>Total que faltan votar</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><span class="pull-right text-white voto" p-5><?php echo $votos_habilitados["total"]; ?></span></td>
              <td><span class="pull-right text-white voto" p-5><?php echo $votosTotales["total"]; ?></span></td>
              <td><span class="pull-right text-white voto" p-5><?php echo $voto_pc["total"]; ?></span></td>
              <td><span class="pull-right text-white voto" p-5><?php echo $faltaVotar["total"]; ?></span></td>
            </tr>
          </tbody>
        </table>



      </div>

      <hr>
      <br>
      <h3 class="box-title">Tabla de participación por Ciudad</h3>
      <br>
      <div class="col-md-12">


        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li id="breadcrumb-tabla" class="breadcrumb-item"><button id="toggle-tabla" class="btn btn-primary">Mostrar Participación por ciudad (mostrar / ocultar)</button></li>
          </ol>
        </nav>

        <div id="tabla-container" class="tabla-container" style="display: none;">
          <table id="example3" class="table table-bordered table-striped tablas text-center bg-light">
            <thead>
              <tr>
                <th>Ciudad</th>
                <th>Total habilitados</th>
                <th>Total de participación</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($voto_ciudad as $voto) {
                $ciudad = $voto['ciudad'];
                $votos = $voto['votos'];
                $participacion = $voto['participacion'];

                echo "
            <tr>
              <td>$ciudad</td>
              <td>$votos</td>
              <td>$participacion</td>
            </tr>
          ";
              }
              ?>
            </tbody>
          </table>
        </div>






      </div>

    </div>

  </div>

  <!-- <div class="box-footer no-padding">
    	
		<ul class="">
			
			 <?php


        $votos = 0;

        foreach ($votantes as $key => $value) {


          //$votos = ControladorPuntero::ctrMostrarCantidadVotante($value["id_lider"]);



          echo '


              <li>
						 
    						 <p>' . $value["nombre"] . '<span class="pull-right text-' . $colores[1] . '"> Ya Voto  </span>
    			       </p>
                 

      				</li> ';
        }

        ?>


		</ul>

    </div> -->

</div>

<script>
  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart1').get(0).getContext('2d');

  var pieChart = new Chart(pieChartCanvas);
  console.log(pieChart);
  var PieData = [

    <?php



    for ($i = 0; $i < 1; $i++) {

      $votos = ControladorPuntero::ctrVotanteTotal($sede);


      echo '
                 {
                    value    : ' . ceil(intval($votos["total"]) * 100 / intval($total["total"])) . ',
                    color    : "' . $colores[$i] . '",
                    highlight: "' . $colores[$i] . '",
                    label    : " % de votos"
                  },

              ';
    }



    ?>
  ];
  var pieOptions = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke: true,
    // String - The colour of each segment stroke
    segmentStrokeColor: '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth: 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps: 100,
    // String - Animation easing effect
    animationEasing: 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate: true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale: false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive: true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: false,
    // String - A legend template
    legendTemplate: '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate: '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);

  // -----------------
  // - END PIE CHART -
  // -----------------
</script>
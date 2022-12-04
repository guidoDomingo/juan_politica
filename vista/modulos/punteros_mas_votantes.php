<?php

$item = null;
$valor = null;


$productos = ControladorPuntero::ctrMostrarPunterosUnicos($item, $valor);

$colores = array("red","green","yellow","aqua","purple","blue","cyan","magenta","orange","gold");

$total = ControladorPuntero::ctrMostrarSumaPuntero();


?>

<!--=====================================
PRODUCTOS MÁS VENDIDOS
======================================-->

<div class="box box-default">
	
	<div class="box-header with-border">
  
      <h3 class="box-title">Punteros con más votantes</h3>

    </div>

	<div class="box-body">
    
      	<div class="row">

	        <div class="col-md-7">

	 			<div class="chart-responsive">
	            
	            <canvas id="pieChart" height="150"></canvas>
	          
	          	</div>

	        </div>

		    <div class="col-md-5">
		      	
		  

		    </div>

		</div>

    </div>

    <div class="box-footer no-padding punteroVotante p-3">
    	
		<ul class="">
			
			 <?php


            $votos = 0;
            
          	foreach ($productos as $key => $value) {
              //var_dump($key);
              
              $votos = ControladorPuntero::ctrMostrarCantidadVotante($value["id_lider"]);
                       
                 $ya_voto = ModeloPuntero::mdlCantidadVotoPorPuntero("puntero",$value["id_lider"]);

              	if($votos[0] == $ya_voto["total"]){

                  	echo '
          				<li>
						 
    						 <p>'.$value["nombre"].'<span class="pull-right text-'.$colores[$key].'">   
    						 '.ceil(intval($votos[0])*100/intval($total["total"])).'% ,Votantes: <strong>'.$votos[0].'</strong>, <span class="bg-green text-white votoPuntero p-2">de estos ya votaron: '. $ya_voto["total"].'</span></span>
    			       		 </p>
                 

      					</li> 
      					
      					';

                }elseif($ya_voto["total"] <= $votos[0] and $ya_voto["total"] > 0 ){

                 	echo '
          				<li>
						 
    						 <p>'.$value["nombre"].'<span class="pull-right text-'.$colores[$key].'">   
    						 '.ceil(intval($votos[0])*100/intval($total["total"])).'% ,Votantes: <strong>'.$votos[0].'</strong>, <span class="bg-yellow text-white votoPuntero p-2"> de estos ya votaron: '. $ya_voto["total"].'<span> </span>
    			       		 </p>
                 

      					</li> 
      					
      					';

                }elseif($ya_voto["total"] == 0 ){

                 	echo '
          				<li>
						 
    						 <p>'.$value["nombre"].'<span class="pull-right text-'.$colores[$key].'">   
    						 '.ceil(intval($votos[0])*100/intval($total["total"])).'% ,Votantes: <strong>'.$votos[0].'</strong>,<span class="bg-red text-white votoPuntero p-2"> de estos ya votaron: '. $ya_voto["total"].'<span> </span>
    			       		 </p>
                 

      					</li> 
      					
      					';

                }

          	

            

			}

			?>


		</ul>

    </div>

</div>

<script>
	

  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');

  var pieChart       = new Chart(pieChartCanvas);
  //console.log(pieChart);
  var PieData        = [

  <?php

  foreach ($productos as $key => $value) {

              
              $votos = ControladorPuntero::ctrMostrarCantidadVotante($value["id_lider"]);
         
              

              echo '
                 {
                    value    : '.ceil(intval($votos[0])*100/intval($total["total"])).',
                    color    : "'.$colores[$key].'",
                    highlight: "'.$colores[$key].'",
                    label    : "% '.$value["nombre"].'"
                  },

              ';

            

      }

    
   ?>
  ];
  var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
 pieChart.Doughnut(PieData, pieOptions);

  // -----------------
  // - END PIE CHART -
  // -----------------


</script>
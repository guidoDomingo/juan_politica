
<div class="content-wrapper">

   <section class="content-header d-flex justify-content-between">
    
    <h1>
      
      Reportes
    
    </h1>

    <ol class="breadcrumb ">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio /</a></li>
      
      <li class="active" style="margin-left:7px">Administrar reportes</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">


      <div class="box-body">
        
        <div class="row">


           <div class="col-md-6 col-xs-12">
             
            <?php

            include "punteros_mas_votantes.php";

            ?>

           </div>

            <div class="col-md-6 col-xs-12">
             
            <?php

            include "reporte_voto_totales.php";

            ?>

           </div>

           <div class="col-md-6 col-xs-12">
             
            <?php

            //include "reportes/compradores.php";

            ?>

           </div>
          
        </div>

      </div>
      
    </div>

  </section>
 
 </div>

<?php

$item = null;
$valor = null;
$orden = "id";

$total_votantes = ControladorPuntero::ctrVotanteTotal(); //total de votantes que ya votaron

$posible_votantes = ControladorPuntero::ctrPosibleVotanteTotal(); //total de votantes

$total_punteros = ControladorPuntero::ctrCantidadTotalLider(); //total de punteros

$total_votantes_sin_puntero = ModeloVotante::mdlSumaTotalVotante();

$total_votantes_sin_puntero_activo = ModeloVotante::mdlSumaTotalVotanteActivo();

?>

<div class="cajaSuperior">

<div class="col-md-4 col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">
    
    <div class="inner">
      
      <h3><?php echo $total_votantes["total"]; ?></h3>

      <p>Votos chequeados</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-social-usd"></i>
    
    </div>
    
    <a href="reportes" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-md-4 col-lg-3 col-xs-6">

  <div class="small-box bg-green">
    
    <div class="inner">
    
      <h3><?php echo $posible_votantes["total"]; ?></h3>

      <p>Posible votantes</p>
    
    </div>
    
    <div class="icon">
    
      <i class="ion ion-clipboard"></i>
    
    </div>
    
    <a href="puntero" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-md-4 col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">
    
    <div class="inner">
    
      <h3><?php echo $total_punteros["total"]; ?></h3>

      <p>Cantidad de punteros</p>
  
    </div>
    
    <div class="icon">
    
      <i class="ion ion-person-add"></i>
    
    </div>
    
    <a href="lider" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>
<div class="col-md-4 col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">
    
    <div class="inner">
    
      <h3><?php echo $total_votantes_sin_puntero["total"]; ?></h3>

      <p>Cantidad total de votantes sin puntero</p>
  
    </div>
    
    <div class="icon">
    
      <i class="ion ion-person-add"></i>
    
    </div>
    
    <a href="voto-sin-puntero" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="small-box bg-aqua">
    
    <div class="inner">
    
      <h3><?php echo $total_votantes_sin_puntero_activo["total"]; ?></h3>

      <p>Votos chequeados de votantes sin puntero </p>
  
    </div>
    
    <div class="icon">
    
      <i class="ion ion-person-add"></i>
    
    </div>
    
    <a href="voto-sin-puntero" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

</div>


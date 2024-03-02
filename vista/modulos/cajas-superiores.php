<?php

$item = null;
$valor = null;
$orden = "id";

if(isset($_POST['sede'])) {

  $sede = $_POST['sede'];

  $total_votantes = ControladorPuntero::ctrVotanteTotal($sede); //total de votantes que ya votaron
  
  $posible_votantes = ControladorPuntero::ctrPosibleVotanteTotal($sede); //total de votantes

}


$total_punteros = ControladorPuntero::ctrCantidadTotalLider(); //total de punteros

$total_votantes_sin_puntero = ModeloVotante::mdlSumaTotalVotante();

$total_votantes_sin_puntero_activo = ModeloVotante::mdlSumaTotalVotanteActivo();

?>


<div class="cajaSuperior">


<div class="col-md-4">
    <div id="sedes_select_div" class="form-group">
        <form action="" method="POST">
            <select id="sedes_select" class="form-control" name="sede">
                <option value="caacupe" <?php if(isset($_POST['sede']) && $_POST['sede'] == 'caacupe') echo 'selected'; ?>>Caacupé</option>
                <option value="loma_grande" <?php if(isset($_POST['sede']) && $_POST['sede'] == 'loma_grande') echo 'selected'; ?>>Loma Grande</option>
                <!-- Agrega más opciones según sea necesario -->
            </select>
            <input type="submit" class="btn btn-primary" value="Enviar">
        </form>
    </div>
</div>

<div class="col-md-12"></div>
<div class="col-md-4 col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">
    
    <div class="inner">
      
      <h3><?php echo $total_votantes["total"]  ?? 0; ?></h3>

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
    
      <h3><?php echo $posible_votantes["total"] ?? 0; ?></h3>

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


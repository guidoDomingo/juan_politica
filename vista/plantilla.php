
<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrar Punteros</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

     <!--=====================================
  PLUGINS DE CSS
  ======================================-->

 

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vista/plugins/fontawesome-free/css/all.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vista/dist/css/adminlte.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="vista/css/estilos.css">

    <!-- DataTables -->
  <link rel="stylesheet" href="vista/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vista/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="vista/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  
  <!-- PLUGINS DE JS -->

  <!-- jQuery -->
  <script src="vista/plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="vista/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- CDN SELECT 2 -->
  <link href="vista/plugins/select2/css/select2.css" rel="stylesheet" />
  <script src="vista/plugins/select2/js/select2.min.js"></script>

  <!-- AdminLTE App -->
  <script src="vista/dist/js/adminlte.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <!-- <script src="vista/dist/js/demo.js"></script> -->

  <!-- DataTables  & Plugins -->
  <script src="vista/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="vista/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="vista/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="vista/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="vista/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="vista/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="vista/plugins/jszip/jszip.min.js"></script>
  <script src="vista/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="vista/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="vista/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="vista/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="vista/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="vista/plugins/sweetalert.min.js"></script>

  <script src="vista/plugins/chart.js/Chart.js"></script>


</head>
<!-- CUERPO DE LA CABECERA -->

<body class="hold-transition sidebar-collapse sidebar-mini">

 
  <!-- MODULO DE LA CABECERA -->
  <?php
  
    if( isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok" ){

    echo '<div class="wrapper">';
    
    include 'modulos/cabecera.php';

    include 'modulos/menu-lateral.php';


     /*=============================================
    CONTENIDO
    =============================================*/

    if(isset($_GET["ruta"])){

      if($_GET["ruta"] == "inicio" ||
         $_GET["ruta"] == "usuarios" ||
         $_GET["ruta"] == "puntero" ||
         $_GET["ruta"] == "lider" ||
         $_GET["ruta"] == "voto-sin-puntero" ||
         $_GET["ruta"] == "cajas-superiores" ||
         $_GET["ruta"] == "reportes" ||
         $_GET["ruta"] == "salir"){

        include "modulos/".$_GET["ruta"].".php";

      }else{

        include "modulos/404.php";

      }

    }else{

      include "modulos/inicio.php";

    }

    
     /*=============================================
    FOOTER
    =============================================*/

    include "modulos/footer.php";

    echo '</div>';

    }else{

        include "modulos/login.php";

    }
    
  ?>
  <!-- Main Sidebar Container -->
 

<!-- ./wrapper -->


<!-- <script src="vista/js/usuarios.js"></script>
<script src="vista/js/categoria.js"></script>
<script src="vista/js/proveedor.js"></script>
<script src="vista/js/equipo.js"></script>
<script src="vista/js/planta.js"></script>-->
<script src="vista/js/lider.js"></script> 
<script src="vista/js/puntero.js"></script>
<script src="vista/js/votante.js"></script>
<script src="vista/js/plantilla.js"></script>
</body>
</body>
</html>

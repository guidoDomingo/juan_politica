/*=============================================
    TRAER VOTANTES MEDIANTE AJAX
=============================================*/


$('#tablasVotantes').DataTable( {
    "ajax": "ajax/datatable-votantes-sin-puntero.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {

      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }

  }

} );








$("#tablasVotantes").on("click", ".btnEditarPunteroVotante", function(){

	var idVotante = $(this).attr("idvotante");
	console.log("puntero",idVotante);
	var datos = new FormData();
	datos.append("idVotante", idVotante);

	$.ajax({
	    url:"ajax/votante.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success: function(respuesta){
	    	console.log("respuesta", respuesta);

     		$("#editarNombre").val(respuesta["nombre"]);
     		$("#editarApellido").val(respuesta["apellido"]);
     		$("#editarCiudad").val(respuesta["ciudad"]);
     		$("#editarBarrio").val(respuesta["barrio"]);
     		$("#editarTelefono").val(respuesta["telefono"]);
     		$("#editarCedula").val(respuesta["cedula"]);
     		$("#editarZona").val(respuesta["zona"]);
     		$("#idPersona").val(idVotante);
     		$("#editarLugar").val(respuesta["lugar_votacion"]);
     		$("#editarNumeroMesa").val(respuesta["numero_mesa"]);
     		$("#editarOrden").val(respuesta["numero_orden"]);
     	}

	});
})



$("#tablasVotantes").on("click",".btnEliminarPunteroVotante", function(){

	var idVotante = $(this).attr("idVotante");
	console.log(idVotante);

	swal({
	  title: "Qieres eliminar",
	  text: "Estas seguro ?",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	    window.location = "index.php?ruta=voto-sin-puntero&idVotante="+idVotante;
	  } 
	});

});

/*=============================================
REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
=============================================*/

$("#validarCedulaVotante").change(function(){

  $(".alert").remove();

  var cedula = $(this).val();
  console.log(cedula);
  var datos = new FormData();
  datos.append("validarCedula", cedula);

   $.ajax({
      url:"ajax/votante.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success:function(respuesta){
      	console.log("respuesta", respuesta);
        
        if(respuesta){

          $("#validarCedulaVotante").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');

          $("#validarCedulaVotante").val("");

        }else{

          var datos_nuevo = new FormData();
          datos_nuevo.append("cedula_excel", cedula);

          $.ajax({
            url:"ajax/puntero.ajax.php",
            method:"POST",
            data: datos_nuevo,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){
              console.log(respuesta)
              $("#nuevoNombre").val(respuesta["nombre"]);
              $("#nuevoApellido").val(respuesta["apellido"]);
              $("#nuevoBarrio").val(respuesta["direccion"]);
              $("#nuevoCiudad").val("SAN BERNARDINO");
              $("#nuevoMesa").val(respuesta["mesa"]);
              $("#nuevoOrden").val(respuesta["orden"]);
            }

          })
        }

      }

  })
})


/*=============================================
ACTIVAR SI YA VOTO
=============================================*/
$("#tablasVotantes").on("click", ".btnActivarVotante", function(){

  var idVotante = $(this).attr("idVotante");
  var estadoVotante = $(this).attr("estadoVotante");

  var datos = new FormData();
  datos.append("activarId", idVotante);
    datos.append("activarVotante", estadoVotante);

    $.ajax({

    url:"ajax/votante.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

          if(window.matchMedia("(max-width:767px)").matches){

             swal({
            title: "Estado del voto actualizado",
            type: "success",
            confirmButtonText: "¡Cerrar!"
          }).then(function(result) {
              if (result.value) {

                window.location = "voto_sin_puntero";

              }


        });

          }

      }

    })

    if(estadoVotante == 0){

      $(this).removeClass('btn-success');
      $(this).addClass('btn-danger');
      $(this).html('No Voto');
      $(this).attr('estadoVotante',1);

    }else{

      $(this).addClass('btn-success');
      $(this).removeClass('btn-danger');
      $(this).html('Si voto');
      $(this).attr('estadoVotante',0);

    }

})

/*=============================================
ACTIVAR SI YA VISITO
=============================================*/
$("#tablasVotantes").on("click", ".btnVisitado", function(){

  var idVotante = $(this).attr("idVisitado");
  var estadoVotante = $(this).attr("estadoVisitado");

  var datos_visitado = new FormData();
  datos_visitado.append("idVisitado", idVotante);
  datos_visitado.append("activarVisitado", estadoVotante);

    $.ajax({

    url:"ajax/votante.ajax.php",
    method: "POST",
    data: datos_visitado,
    cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

          if(window.matchMedia("(max-width:767px)").matches){

             swal({
            title: "Estado del voto actualizado",
            type: "success",
            confirmButtonText: "¡Cerrar!"
          }).then(function(result) {
              if (result.value) {

                window.location = "voto_sin_puntero";

              }


        });

          }

      }

    })

    if(estadoVotante == 0){

      $(this).removeClass('btn-success');
      $(this).addClass('btn-danger');
      $(this).html('No');
      $(this).attr('estadoVisitado',1);

    }else{

      $(this).addClass('btn-success');
      $(this).removeClass('btn-danger');
      $(this).html('Si');
      $(this).attr('estadoVisitado',0);

    }

})

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.select2').select2();
});
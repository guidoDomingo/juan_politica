/*=============================================
    TRAER VOTANTES CON PUNTEROS MEDIANTE AJAX
=============================================*/

// $("#tablasPuntero")
//   .DataTable({
//     ajax: "ajax/datatable-votantes-con-puntero.ajax.php",
//     deferRender: true,
//     retrieve: true,
//     processing: true,

//     language: {
//       sProcessing: "Procesando...",
//       sLengthMenu: "Mostrar _MENU_ registros",
//       sZeroRecords: "No se encontraron resultados",
//       sEmptyTable: "Ningún dato disponible en esta tabla",
//       sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
//       sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
//       sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
//       sInfoPostFix: "",
//       sSearch: "Buscar:",
//       sUrl: "",
//       sInfoThousands: ",",
//       sLoadingRecords: "Cargando...",
//       oPaginate: {
//         sFirst: "Primero",
//         sLast: "Último",
//         sNext: "Siguiente",
//         sPrevious: "Anterior",
//       },
//       oAria: {
//         sSortAscending:
//           ": Activar para ordenar la columna de manera ascendente",
//         sSortDescending:
//           ": Activar para ordenar la columna de manera descendente",
//       },
//     },
//     dom: "Bfrtip",
//     buttons: ["copy", "csv", "excel", "pdf", "print"],
//   })
//   .buttons()
//   .container()
//   .appendTo("#tablasPuntero_wrapper .col-md-6:eq(0)");

$(".tablas").on("click", ".btnEditarPuntero", function () {
  var idPuntero = $(this).attr("idPuntero");
  console.log("puntero", idPuntero);
  var datos = new FormData();
  datos.append("idPuntero", idPuntero);

  $.ajax({
    url: "ajax/puntero.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      //console.log("respuesta", respuesta);

      var datos = new FormData();
      datos.append("idLider", respuesta["id_lider"]);

      $.ajax({
        url: "ajax/puntero.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta_lider) {
          //console.log("respuesta", respuesta_lider);

          $("#nuevoLider").val(respuesta_lider["id_lider"]);
        },
      });

      $("#editarNombre").val(respuesta["nombre"]);
      $("#editarApellido").val(respuesta["apellido"]);
      $("#editarCiudad").val(respuesta["ciudad"]);
      $("#editarBarrio").val(respuesta["barrio"]);
      $("#editarTelefono").val(respuesta["telefono"]);
      $("#editarCedula").val(respuesta["cedula"]);
      $("#editarZona").val(respuesta["zona"]);
      $("#idPersona").val(idPuntero);
      $("#editarLugar").val(respuesta["lugar_votacion"]);
      $("#editarNumeroMesa").val(respuesta["numero_mesa"]);
      $("#editarOrden").val(respuesta["numero_orden"]);
    },
  });
});

$(".tablas").on("click", ".editarPlanta", function () {
  var idPlanta = $(this).attr("idPlanta");
  console.log(idPlanta);

  var datos = new FormData();
  datos.append("idPlanta", idPlanta);

  $.ajax({
    url: "ajax/planta.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editar_planta").val(respuesta["nombre"]);
      $("#idPlanta").val(respuesta["id"]);
    },
  });
});

$(".tablas").on("click", ".btnEliminarPuntero", function () {
  var idPuntero = $(this).attr("idPuntero");
  console.log(idPuntero);

  swal({
    title: "Qieres eliminar",
    text: "Estas seguro ?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      window.location = "index.php?ruta=puntero&idPuntero=" + idPuntero;
    }
  });
});

/*=============================================
REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
=============================================*/

$("#validarCedulaPuntero").change(function () {
  $(".alert").remove();

  var cedula = $(this).val();
  console.log(cedula);
  var datos = new FormData();
  datos.append("validarCedula", cedula);

  $.ajax({
    url: "ajax/puntero.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#validarCedulaPuntero")
          .parent()
          .after(
            '<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>'
          );

        $("#validarCedulaPuntero").val("");
      } else {
        var datos_nuevo = new FormData();
        datos_nuevo.append("cedula_excel", cedula);

        $.ajax({
          url: "ajax/puntero.ajax.php",
          method: "POST",
          data: datos_nuevo,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (respuesta) {
            console.log(respuesta);
            $("#nuevoNombre").val(respuesta["nombre"]);
            $("#nuevoApellido").val(respuesta["apellido"]);
            $("#nuevoBarrio").val(respuesta["direccion"]);
            $("#nuevoCiudad").val(respuesta["direccion"]);
            $("#nuevoLugar").val(respuesta["local"]);
            $("#nuevoNumeroMesa").val(respuesta["mesa"]);
            $("#nuevoOrden").val(respuesta["orden"]);
          },
        });
      }
    },
  });
});


/*=============================================
ACTIVAR SI YA VOTO
=============================================*/
$(".tablas").on("click", ".btnActivar", function () {
  var idVotante = $(this).attr("idVotante");
  var estadoVotante = $(this).attr("estadoVotante");

  var datos = new FormData();
  datos.append("activarId", idVotante);
  datos.append("activarUsuario", estadoVotante);
  datos.append("columna", "activo");

  $.ajax({
    url: "ajax/puntero.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (window.matchMedia("(max-width:767px)").matches) {
        swal({
          title: "Estado del voto actualizado",
          type: "success",
          confirmButtonText: "¡Cerrar!",
        }).then(function (result) {
          if (result.value) {
            window.location = "puntero";
          }
        });
      }
    },
  });

  if (estadoVotante == 0) {
    $(this).removeClass("btn-success");
    $(this).addClass("btn-danger");
    $(this).html("No Voto");
    $(this).attr("estadoVotante", 1);
  } else {
    $(this).addClass("btn-success");
    $(this).removeClass("btn-danger");
    $(this).html("Si voto");
    $(this).attr("estadoVotante", 0);
  }
});

/*=============================================
ACTIVAR SI YA VOTO VEEDOR
=============================================*/
$(".tablas").on("click", ".btnActivarVeedor", function () {
  var idVotante = $(this).attr("idVotante");
  var estadoVotante = $(this).attr("estadoVotante");

  var datos = new FormData();
  datos.append("activarId", idVotante);
  datos.append("activarUsuarioVeedor", estadoVotante);
  datos.append("columna", "activo_veedor");

  $.ajax({
    url: "ajax/puntero.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (window.matchMedia("(max-width:767px)").matches) {
        swal({
          title: "Estado del voto actualizado",
          type: "success",
          confirmButtonText: "¡Cerrar!",
        }).then(function (result) {
          if (result.value) {
            window.location = "puntero";
          }
        });
      }
    },
  });

  if (estadoVotante == 0) {
    $(this).removeClass("btn-success");
    $(this).addClass("btn-danger");
    $(this).html("No paso");
    $(this).attr("estadoVotante", 1);
  } else {
    $(this).addClass("btn-success");
    $(this).removeClass("btn-danger");
    $(this).html("ya paso");
    $(this).attr("estadoVotante", 0);
  }
});

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function () {
  $(".select2").select2();
  
});

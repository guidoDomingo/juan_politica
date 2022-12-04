$(".tablas").on("click", ".btnEditarLider", function(){

	var idPersona = $(this).attr("idPersona");
	console.log(idPersona);

	var datos = new FormData();
	datos.append("idPersona", idPersona);

	$.ajax({
	    url:"ajax/lider.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success: function(respuesta){
     		$("#editarNombre").val(respuesta["nombre"]);
     		$("#editarApellido").val(respuesta["apellido"]);
     		$("#editarCiudad").val(respuesta["ciudad"]);
     		$("#editarBarrio").val(respuesta["barrio"]);
     		$("#editarTelefono").val(respuesta["telefono"]);
     		$("#editarCedula").val(respuesta["cedula"]);
     		$("#editarZona").val(respuesta["zona"]);
     		$("#idPersona").val(respuesta["id_persona"]);
     	}
	});
})



$(".tablas").on("click", ".editarPlanta", function(){
	var idPlanta = $(this).attr("idPlanta");
	console.log(idPlanta);

	var datos = new FormData();
	datos.append("idPlanta", idPlanta);

	$.ajax({
	    url:"ajax/planta.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success: function(respuesta){
     		$("#editar_planta").val(respuesta["nombre"]);
     		$("#idPlanta").val(respuesta["id"]);
     	}
	});

	
});

$(".tablas").on("click",".btnEliminarLider", function(){

	var idPersona = $(this).attr("idPersona");
	var idLider = $(this).attr("idLider");
	console.log(idPersona);
	console.log(idLider);
	swal({
	  title: "Qieres eliminar",
	  text: "Estas seguro ?",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	    window.location = "index.php?ruta=lider&idPersona="+idPersona+"&idLider="+idLider;
	  } 
	});

});

/*=============================================
REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
=============================================*/

$("#validarCedula").change(function(){

  $(".alert").remove();

  var cedula = $(this).val();
  console.log(cedula);
  var datos = new FormData();
  datos.append("validarCedula", cedula);

   $.ajax({
      url:"ajax/lider.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success:function(respuesta){
      	console.log("respuesta", respuesta);
        
        if(respuesta){

          $("#validarCedula").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');

          $("#validarCedula").val("");

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
			  },
			});
		  }

      }

  })
})
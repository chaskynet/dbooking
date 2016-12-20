/*******
*
* Author: Jorge Anibal Zapata Agreda
* Company: DynaThree
* Desc: Funciones
*
/*******/

$(document).on("click",'[data-toggle="popover"]', function(){
  $(this).popover();
});

function number_format(number, decimals, dec_point, thousands_sep) {
  number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}

/****************************************************
*                         *
* Desc: Carga la pagina de Gestion de Usuarios   *
*                         *
*****************************************************/
$(document).on('click','#gestion-usuarios', function(e){
  e.preventDefault();
  $('#contenido').load('gestion_usuarios');
  menuClose();
});

$(document).on('hide.bs.modal','#modal_creacion_usuarios', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('#contenido').load('gestion_usuarios');
    // if(!confirm('You want to close me?'))
    //  e.preventDefault();
});

$(document).on('hide.bs.modal','#modal_edita_usuario', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('#contenido').load('gestion_usuarios');
    // if(!confirm('You want to close me?'))
    //  e.preventDefault();
});

$(document).on('click', '#crear_usuario', function(e){
  e.preventDefault();
  var usuario = new Array();
  var datos_usuario = new Array();
  var lista_permisos = new Array();

  var crear_usuario = new Object();
  var permisos_usuario = new Object()
  crear_usuario.uname = $('#usuario').val();
  crear_usuario.nombre = $('#nombre').val();
  crear_usuario.apaterno = $('#apaterno').val();
  crear_usuario.amaterno = $('#amaterno').val();
  crear_usuario.ci = $('#ci').val();
  crear_usuario.password = $('#password').val();

  $( "input[type=checkbox]:checked").each(function(){ 
      console.log($(this).attr('id'));
      permisos_usuario = $(this).attr('id');
      lista_permisos.push(permisos_usuario);
  });

  datos_usuario.push(crear_usuario);
  
  usuario.push(datos_usuario);
  usuario.push(lista_permisos);

  var new_usuario = JSON.stringify(usuario);

  $.ajax({
        url: 'nuevo_usuario',
        data: {data: new_usuario},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          console.log('Usuario creado correctamente! '+response);
          //alert('Usuario creado correctamente!');
          $('#usuario').val('');
          $('#nombre').val('');
          $('#apaterno').val('');
          $('#amaterno').val('');
          $('#ci').val('');
          $('#password').val('');
        }
  });
});

$(document).on('hide.bs.modal','#modal_creacion_usuarios', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('#contenido').load('gestion_usuarios');
});

/****** Abre ventana de Usuario para editarlo ******/
$(document).on('click', '#nombre_usuario', function(e){
  e.preventDefault();
  var objFila=$(this).parents().get(1);
  var id_usuario = $(objFila).attr('id');
  $.ajax({
    url: 'carga_datos_usuario',
        data: {data: id_usuario},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          var objeto = JSON.parse(response);
           
          $.each(objeto.datos_usuario, function(i, item) {
            $('#id_usuario').val(id_usuario);
            $('#ed_usuario').val(item.uname);
            $('#ed_nombre').val(item.nombre);
            $('#ed_apaterno').val(item.apaterno);
            $('#ed_amaterno').val(item.amaterno);
            $('#ed_ci').val(item.ci);
            $('#ed_password').val(password);
            $("input[name=ed_rol]:checked").val(item.rol);
          });
          $.each(objeto.permisos, function(i, item){

            if (item == 'chk_adm_hab') {
              $('#chk_adm_hab').prop('checked', true);
            }else if (item == 'chk_gestion_usrs'){
              $('#chk_gestion_usrs').prop('checked', true);
            }else if (item == 'chk_adm_clientes'){
              $('#chk_adm_clientes').prop('checked', true);
            }else if (item == 'chk_asigna_hab'){
              $('#chk_asigna_hab').prop('checked', true);
            }else if (item == 'chk_rep_caja'){
              $('#chk_rep_caja').prop('checked', true);
             }
          }); 
        }
  });
  $('#modal_content_usuario').html();
});

$(document).on('click', '#chk_password', function(){
  $('#ed_password').prop('disabled', false);
});

$(document).on('click', '#actualizar_usuario', function(){
  var usuario = new Array();
  var datos_usuario = new Array();
  var lista_permisos = new Array();

  var usuario_actualizado = new Object();
  var permisos_usuario = new Object();

  usuario_actualizado.id_usuario = $('#id_usuario').val();
  usuario_actualizado.uname = $('#ed_usuario').val();
  usuario_actualizado.nombre = $('#ed_nombre').val();
  usuario_actualizado.apaterno = $('#ed_apaterno').val();
  usuario_actualizado.amaterno = $('#ed_amaterno').val();
  usuario_actualizado.ci = $('#ed_ci').val();
  if ($('#chk_password').prop('checked')) {
    usuario_actualizado.password = $('#ed_password').val();
  }

  $( "input[type=checkbox]:checked").each(function(){ 
    //console.log($(this).attr('id'));
    permisos_usuario = $(this).attr('id');
    lista_permisos.push(permisos_usuario);
  });

  datos_usuario.push(usuario_actualizado);
  
  usuario.push(datos_usuario);
  usuario.push(lista_permisos);

  var update_usuario = JSON.stringify(usuario);

  $.ajax({
        url: 'actualizar_usuario',
        data: {data: update_usuario},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          alert('Usuario Actualizado correctamente!');
          $('#ed_usuario').val('');
          $('#ed_nombre').val('');
          $('#ed_apaterno').val('');
          $('#ed_amaterno').val('');
          $('#ed_ci').val('');
          $('#ed_password').val('');
        }
      });
});

$(document).on('click', '#elimina_usr', function(){
  var objFila=$(this).parents().get(1);
  var id_usuario = $(objFila).attr('id');
  $.ajax({
        url: 'elimina_usuario',
        data: {data: id_usuario},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Borrar!');
        },
        success: function(response)
        {
          alert('Usuario Borrado correctamente!');
          $('#contenido').load('gestion_usuarios');
        }
      });
});

/****************************************************
*                         *
* Author: Jorge Anibal Zapata Agreda
* Desc: Carga la pagina de Gestion de Habitaciones   *
*                         *
*****************************************************/
$(document).on("click","#asignar_habitacion",function(e){
  e.preventDefault();
  $('#contenido').load('asignar_habitaciones');
  menuClose();
});

$(document).on('click','#adm_habitaciones', function(e){
  e.preventDefault();
  $('#contenido').load('gestion_habitaciones');
  menuClose();
});

/*********** Sección de Habitación ***********/

/**** Registra un nuevo tipo de habitacion *****/
$(document).on('click', '#nueva_habitacion',function(){
  
  $.ajax({
      url: 'lista_tipo_hab',
      //data: {data: datos},
      type: "POST",
      dataType: "html",
      error: function()
      {
          alert('Error al Guardar la Habitación!');
      },
      success: function(response)
      {
        $('#tipo_hab').html("<option value='0'>...</option>");
        var objeto = JSON.parse(response);
        $.each(objeto, function(i, item) {
          $('#tipo_hab').append("<option value='"+item.id_tipo_hab+"'>"+item.descripcion+"</option>");
        });
      }
  });
});

/**** Registra una nueva habitacion habitacion a nivel de configuración *****/
$(document).on("click","#nueva_hab", function(e){
  e.preventDefault();
  var cod_hab = $("#cod_hab"),
      tipo_hab = $("#tipo_hab"),
      estado_hab = $("#estado_hab"),
      objeto = new Object();
  objeto.cod_hab = cod_hab.val();
  objeto.tipo_hab = tipo_hab.val();
  objeto.estado_hab = estado_hab.val();
  var datos = JSON.stringify(objeto);
  $.ajax({
      url: 'guarda_hab',
      data: {data: datos},
      type: "POST",
      dataType: "html",
      error: function()
      {
          alert('Error al Guardar la Habitación!');
      },
      success: function(response)
      {
        alert('Habitación guardada!');
        $('#habitaciones_conf tbody').empty();
        var objeto = JSON.parse(response);
        var j = 1;
        // var cadena = '';
        $.each(objeto, function(i, item) {
          var cadena = "<tr id= '"+item.id_habitacion+"'><td>"+j+ '&nbsp; <a href="#" id="elimina_hab"><span class="glyphicon glyphicon-trash"></span></a>'+
                    "</td>"+
                    "<td><a href='#' data-toggle='modal' data-target='#modal_edit_conf_habitacion' id='cod_hab'>"+item.codigo+
                    "</td>"+
                    "<td>"+item.descripcion+
                    "</td>"+
                    "<td>"+item.costo+
                    "</td>"+
                    "<td>"+item.estado+
                    "</td></tr>";
          j++;
          console.log('cadena: '+cadena);
          $('#habitaciones_conf tbody').append(cadena);
        });
      }
  });

});

/*********** Sección tipos de Habitación ***********/
$(document).on('click','#edit_tipo',function(e){
  //e.preventDefault();
  var objeto = $(this).parents().get(1);
  var id_tipo = $(objeto).attr('id');
  var tipo_desc = $(this);
  var num_personas = $(objeto).find('#tipo_num_per');
  var costo = $(objeto).find('#tipo_costo');
  
  $("#ed_id_tipo").val(id_tipo);
  $("#ed_desc_tipo_hab").val(tipo_desc.text());
  $("#ed_num_personas").val(num_personas.text());
  $("#ed_costo_hab").val(costo.text());

});

$(document).on('click', '#guarda_tipo', function(){
  var desc_tipo_hab = $("#desc_tipo_hab"),
      num_personas = $("#num_personas"),
      costo_hab = $("#costo_hab"),
      objeto = new Object();
  objeto.desc_tipo_hab = desc_tipo_hab.val();
  objeto.num_personas = num_personas.val();
  objeto.costo_hab = costo_hab.val();
  var datos = JSON.stringify(objeto);
  $.ajax({
        url: 'guarda_tipo_hab',
        data: {data: datos},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar el Tipo!');
        },
        success: function(response)
        {
          alert('Tipo de Habitacion guardada!');
          var cant_filas = parseInt($("#tabla_tipo_habitaciones tbody tr").length)+1;
          var cadena = "<tr id='"+
                        response+
                        "'><td>"+
                        cant_filas+
                        "</td><td id='tipo_desc'><a href='#' id='edit_tipo' data-toggle='modal' data-target='#modal_edit_tipo_habitacion'>"+
                        desc_tipo_hab.val()+
                        "</a></td><td id='tipo_num_per'>"+
                        num_personas.val()+
                        "</td><td id='tipo_costo'>"+
                        costo_hab.val()+
                        "</td></tr>";
          $("#tabla_tipo_habitaciones tbody").append(cadena);
        }
      });
});

$(document).on("click","#edita_tipo",function(e){
  e.preventDefault();
  var objeto = new Object();
  var id_tipo = $("#ed_id_tipo").val();
  var tipo_desc = $("#ed_desc_tipo_hab").val();
  var num_personas = $("#ed_num_personas").val();
  var costo = $("#ed_costo_hab").val();
  objeto.id_tipo = id_tipo;
  objeto.tipo_desc = tipo_desc;
  objeto.num_personas = num_personas;
  objeto.costo = costo;
  var datos = JSON.stringify(objeto);
  $.ajax({
        url: 'edita_tipo_hab',
        data: {data: datos},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Editar el Tipo!');
        },
        success: function(response)
        {
          //alert('Tipo de Habitacion Editada!');
          console.log(response);
          var fila = $("#"+id_tipo);
          fila.find("#tipo_desc").html("<a href='#'' id='edit_tipo' data-toggle='modal' data-target='#modal_edit_tipo_habitacion'>"+tipo_desc+"</a>");
          fila.find("#tipo_num_per").text(num_personas);
          fila.find("#tipo_costo").text(costo);
        }
      });
});

/**** To Do *****/
$(document).on("click", "#edit_conf_habitacion", function(){
  var objeto = $(this).parents().get(1);
  var id_tipo = $(objeto).attr('id');
  console.log(id_tipo);
});

/******* End To Do **********/
$(document).on("click", "#elimina_hab", function(){
  var objeto = $(this).parents().get(1);
  var id_tipo = $(objeto).attr('id');
  $.ajax({
        url: 'elimina_hab',
        data: {data: id_tipo},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Editar el Tipo!');
        },
        success: function(response)
        {
          alert('Habitacion Eliminada Correctamente!');
          $(objeto).remove();
        }
  });
});

$(document).on('click','#btn_chk_in_out',function(){
  var tipo = $.trim($(this).text()),
      codigo = $(this).data('codigo');
  $('.modal-body').empty();
  if (tipo == 'Check In') {
    $('.modal-title').text('Check In Habitación: '+ codigo);
    $('.modal-title').data('codhab', codigo);
    $('.modal-body').load('vista_checking', {data: codigo});
    $('#save_chk_in_out').data('chkinout','chkin');
    
  } else if (tipo == 'Check Out') {
    $('.modal-title').text('Check Out Habitación: '+codigo);
    $('.modal-title').data('codhab', codigo);
    $('.modal-body').load('vista_checkout', {data: codigo});
    $('#save_chk_in_out').data('chkinout','chkout');
    //$('.modal-footer').append('<button type="button" class="btn btn-default" data-dismiss="modal">Sucio</button>');
  } else if (tipo == 'Habilitar') {
    $('.modal-title').text('Habitación: '+codigo);
    $('.modal-title').data('codhab', codigo);
    $('.modal-body').load('vista_habilitar', {data: codigo});
    $('#save_chk_in_out').text('Habilitar Habitacion');
    $('#save_chk_in_out').data('chkinout','chkhab');
  };
});

/********
*
* Des: Boton de Guardado para check in o Check out
*
*********/
$(document).on('click','#save_chk_in_out',function(e){
  e.preventDefault();
  var tipo = $('#save_chk_in_out').data('chkinout');
  switch (tipo) {
    case 'chkin':
      var objeto = new Object();
      objeto.cod_hab = $('.modal-title').data('codhab');
      objeto.fecha_checkin = $('#fecha_checkin').val();
      objeto.hora_checkin = $('#hora_checkin').val();
      objeto.ci_passport = $('#ci_passport').val();
      objeto.nombre_apell = $('#nombre_apell').val();
      objeto.num_personas = $('#num_personas').val();
      objeto.desayuno = $('#desayuno').prop('checked');
      objeto.adelanto = $('#adelanto').val();
      objeto.observaciones = $('#observaciones').val();
      var datos = JSON.stringify(objeto);
      $.ajax({
        url: 'guarda_asignacion',
        data: {data: datos},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al guardar la Asignación!');
        },
        success: function(response)
        {
          // console.log(response);
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
          $('#contenido').load('asignar_habitaciones');
        }
      });
      break;
    case 'chkout':
      var objeto = new Object();
      objeto.cod_habitacion = $('.modal-title').data('codhab');
      objeto.total = $('#total').val();
      datos = JSON.stringify(objeto);
      console.log(datos);
      $.ajax({
        url: 'guarda_checkout',
        data: {data: datos},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error en el CheckOut!');
        },
        success: function(response)
        {
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
          $('#contenido').load('asignar_habitaciones');
        }
      });
      break;
    case 'chkhab':
      var cod_habitacion = $('.modal-title').data('codhab');
      $.ajax({
        url: 'guarda_habilitacion',
        data: {data: cod_habitacion},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al habilitar la habitacion!');
        },
        success: function(response)
        {
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
          $('#contenido').load('asignar_habitaciones');
        }
      });
      break;
  }
});

$(document).on("click", "#add_people", function(e){
  e.preventDefault();
  var num_personas = $('#num_personas img').length;
  var persona = "<a href='#' id='cli"+ 
                    ++num_personas +
                    "' data-toggle='collapse' data-target='#reg_clients"+ num_personas +"' aria-expanded='false' aria-controls='reg_clients' data-target='#reg_clients'>"+
                    "<img src='../assets/images/people.png' class='people'>"+
                "</a>"+
                "<a href='#' id='eliminar_persona' data-id='"+ num_personas +"'><span class='badge'>X</span></a>";
  var tabulador = "<div class='collapse well' id='reg_clients"+ num_personas +"' data-cliente="+ num_personas + ">" +
                    "<div class='row' style = 'margin-left:15px;'>"+
                      "<div class='col-md-4 input-group form-group' style='float: left;'>"+
                        "<span class='input-group-addon' id='label_ci_passport'>CI/Pasaporte: </span>"+
                        "<input type='text' class='form-control' id='ci_passport' aria-describedby='basic-label_ci_passport'>"+
                      "</div>"+
                      "<div class='col-md-7 input-group form-group' style='float: right;with:66%;'>"+
                        "<span class='input-group-addon' id='basic-addon3'>Nombre y Apellidos: </span>"+
                        "<input type='text' class='form-control' id='nombre_apell' aria-describedby='basic-addon3'>"+
                      "</div>"+
                    "</div>"+
                    "<div class='row'>"+
                      "<div class='col-md-3 form-group'>"+
                        "Nacionalidad: "+
                        "<input type='text' class='form-control' id='nacionalidad' aria-describedby='basic-addon3'>"+
                      "</div>"+
                      "<div class='col-md-4 form-group'>"+
                        "Ciudad: "+
                        "<input type='text' class='form-control' id='nacionalidad' aria-describedby='basic-addon3'>"+
                      "</div>"+
                      "<div class='col-md-5 form-group'>"+
                        "Dirección: "+
                        "<input type='text' class='form-control' id='nacionalidad' aria-describedby='basic-addon3'>"+
                      "</div>"+
                    "</div>"+
                  "</div>";
  $('#num_personas').append(persona);
  $('#tabulador_reg_clientes').append(tabulador);
});

$(document).on("click","#eliminar_persona", function(e){
  e.preventDefault();
  var id = $(this).data("id");
  $('#cli'+id).remove();
  $('#reg_clients'+id).remove();
  $(this).remove();
});

/**
* Author: Jorge Anibal Zapata Agreda
* Desc: Realiza la busqueda del nombre de cliente en base al CI o Pasaporte
*/
$(document).on('change', '#ci_passport',function(){
   var url = 'carga_rsocial';
   var nit_cliente = $(this);
   if (nit_cliente.length>0) {
     $.ajax({
          url: url,
          data: {data:nit_cliente.val()},
          type: "POST",
          dataType: "html",
          error: function()
          {
              alert('Error al Cargar la Razon Social!');
          },
          success: function(response)
          {
              var objeto = JSON.parse(response);
              $.each(objeto, function(i, item) {
                $('#nombre_apell').val(item.rsocial);
              });
          }
      });
   }
});

/**
* Author: Jorge Anibal Zapata Agreda
* Desc: Actualiza la Razon Social en base al NIT
*/
$(document).on('change', '#nombre_apell',function(){
   var url = 'actualiza_rsocial';
   var objeto = new Object();
   objeto.rsocial = $(this).val();
   objeto.nit_cliente = $('#ci_passport').val();
   var datos = JSON.stringify(objeto);
   $.ajax({
        url: url,
        data: {data:datos},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Actualizar la Razon Social!');
        },
        success: function(response)
        {
            console.log(response);
        }
    });
});
/****************************************************
*                         *
* Author: Jorge Anibal Zapata Agreda
* Desc: Carga la pagina de Gestion de Habitaciones   *
*                         *
*****************************************************/
$(document).on("click","#gestion-clientes",function(e){
  e.preventDefault();
  $('#contenido').load('gestion_clientes');
  menuClose();
});

/****************************************************
*                         *
*           Sección de Manejo de Caja               *
*                         *
*****************************************************/
$(document).on("click","#caja",function(e){
  e.preventDefault();
  $('#contenido').load('vista_caja');
  menuClose();
});

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

$(document).on('click','#rep_camarera', function(e){
  e.preventDefault();
  $('#contenido_habitaciones').load('reporte_camarera');
});

/*********** Sección de Habitación ***********/

/**** Registra un nuevo tipo de habitacion *****/
var lista_tipo_hab = function(obj){
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
        var elem = "#"+obj;
        $(elem).html("<option value='0'>...</option>");
        var objeto = JSON.parse(response);
        $.each(objeto, function(i, item) {
          $(elem).append("<option value='"+item.id_tipo_hab+"'>"+item.descripcion+"</option>");
        });
      }
  });
};

$(document).on('click', '#nueva_habitacion',function(){
  lista_tipo_hab('tipo_hab');
});

/**** Registra una nueva habitacion habitacion a nivel de configuración *****/
$(document).on("click","#nueva_hab", function(e){
  e.preventDefault();
  var cod_hab = $("#cod_hab"),
      piso_hab = $("#piso_hab"),
      tipo_hab = $("#tipo_hab"),
      estado_hab = $("#estado_hab"),
      objeto = new Object();
  objeto.cod_hab = cod_hab.val();
  objeto.piso_hab = piso_hab.val();
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
        $.each(objeto, function(i, item) {
          var cadena = "<tr id= '"+item.id_habitacion+"'><td>"+j+ '&nbsp; <a href="#" id="elimina_hab"><span class="glyphicon glyphicon-trash"></span></a>'+
                    "</td>"+
                    "<td id='piso_hab'>"+item.piso_hab+
                    "</td>"+
                    "<td><a href='#' data-toggle='modal' data-target='#modal_edit_conf_habitacion' id='edit_conf_habitacion'>"+item.codigo+
                    "</td>"+
                    "<td id='desc_hab'>"+item.descripcion+
                    "</td>"+
                    "<td id='costo_hab'>"+item.costo+
                    "</td>"+
                    "<td id='estado_hab'>"+item.estado+
                    "</td></tr>";
          j++;
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
          desc_tipo_hab.val('');
          num_personas.val('');
          costo_hab.val('');
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
          alert('Tipo de Habitacion Editada!'+id_tipo);
          var fila = $("#tabla_tipo_habitaciones #"+id_tipo);
          fila.find("#tipo_desc").html("<a href='#'' id='edit_tipo' data-toggle='modal' data-target='#modal_edit_tipo_habitacion'>"+tipo_desc+"</a>");
          fila.find("#tipo_num_per").text(num_personas);
          fila.find("#tipo_costo").text(costo);
        }
      });
});

/**** Edicion de Habitaciones *****/
$(document).on("click", "#edit_conf_habitacion", function(){
  var objeto = $(this).parents().get(1),
      id_hab = $(objeto).attr('id');
  $('#id_habitacion_ed').val(id_hab);
  $('#ed_piso_hab').val(($(objeto).find('#piso_hab').text())=='Planta baja'?'0':$(objeto).find('#piso_hab').text());
  $('#ed_cod_hab').val($(objeto).find('#edit_conf_habitacion').text());
  $('#ed_desc_hab').val($(objeto).find('#desc_hab').text());
  lista_tipo_hab('ed_tipo_hab');
});

$(document).on("click", "#edit_hab", function(){
  var id_hab = $('#id_habitacion_ed').val(),
      piso_hab = $('#ed_piso_hab').val(),
      cod_hab = $('#ed_cod_hab').val(),
      //desc_hab = $('#ed_desc_hab').val(),
      tipo_hab = $('#ed_tipo_hab').val(),
      estado_hab = $('#ed_estado_hab').val();
  if (piso_hab.length < 1 || cod_hab.length < 1 || tipo_hab == 0 || estado_hab == 0) {
    alert('Campos incompletos');
  }else {
      var objeto = new Object();
      objeto.id_habitacion = id_hab;
      objeto.piso_hab = piso_hab;
      objeto.cod_hab = cod_hab;
      objeto.tipo_hab = tipo_hab;
      objeto.estado_hab = estado_hab;
      var datos = JSON.stringify(objeto);
      $.ajax({
            url: 'edita_hab',
            data: {data: datos},
            type: "POST",
            dataType: "html",
            error: function(e)
            {
                alert('Error al Editar la Habitacion!'+e);
            },
            success: function(response)
            {
              alert('Habitacion Editada Correctamente!');
              var fila = $("#"+id_hab);
              fila.find("#piso_hab").text((piso_hab=='0'?'Planta Baja':piso_hab));
              fila.find("#edit_conf_habitacion").text(cod_hab);
              fila.find("#desc_hab").text($("#ed_tipo_hab option:selected").text());
              fila.find("#estado_hab").text($("#ed_estado_hab option:selected").text());
            }
      });
  }
});
/********* Fin Edicion de Habitaciones **********/

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

$(document).on("click", "#elimina_tipo_hab", function(){
  var objeto = $(this).parents().get(1);
  var id_tipo = $(objeto).attr('id');
  $.ajax({
        url: 'elimina_tipo_hab',
        data: {data: id_tipo},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Borrar el Tipo!');
        },
        success: function(response)
        {
          alert('Tipo de Habitacion Eliminada Correctamente!');
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
    $('.modal-footer #sec_actualiza').html('<button type="button" class="btn btn-info" data-dismiss="modal" id = "update_room">Actualizar</button>');
    $('.modal-body').load('vista_checkout', {data: codigo});
    $('#save_chk_in_out').data('chkinout','chkout');

  } else if (tipo == 'Habilitar') {
    $('.modal-title').text('Habitación: '+codigo);
    $('.modal-title').data('codhab', codigo);
    $('.modal-body').load('vista_habilitar', {data: codigo});
    $('#save_chk_in_out').text('Habilitar Habitacion');
    $('#save_chk_in_out').data('chkinout','chkhab');
  };
});


/***************************************************
*
* Author: Jorge Anibal Zapata Agreda
* Des: Boton de Actualizacion de habitaciones asignadas
*
***************************************************/
$(document).on('click', '#update_room', function(){
  var habitacion = new Object();
  habitacion.cod_hab = $('.modal-title').data('codhab');
  habitacion.observaciones = $('#observaciones').val();
  habitacion.adelanto = $('#adelanto').val();
  var datos = JSON.stringify(habitacion);
  $.ajax({
          url: 'actualizar_habitacion',
          data: {data: datos},
          type: "POST",
          dataType: "html",
          error: function(response)
          {
              alert('Error al Actualizar la Habitación!->'. response);
          },
          success: function(response)
          {
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            $('#contenido').load('asignar_habitaciones');
          }
        });
});

$(document).on("click", "#habs_por_piso", function(){
  var piso = $(this).data('piso');
  $('#contenido').load('asignar_habitaciones',{data:piso});
});

/***************************************************
*
* Author: Jorge Anibal Zapata Agreda
* Des: Boton de busqueda habitaciones por estado
*
***************************************************/
$(document).on("click", "#busqueda_habs_estado", function(){
  var estado_hab = $(this).data('hab_estado');
  $('#contenido').load('busca_hab_estado',{data:estado_hab});
});

/***************************************************
*
* Author: Jorge Anibal Zapata Agreda
* Des: Boton de Guardado para check in o Check out
*
***************************************************/
$(document).on('click','#save_chk_in_out',function(e){
  e.preventDefault();
  var tipo = $('#save_chk_in_out').data('chkinout');
  switch (tipo) {
    case 'chkin':
        var datos_habitacion = new Array();
        var lista_habitacion = new Array();
        var lista_clientes = new Array();

        var habitacion = new Object();
        var cliente = new Object();

        habitacion.cod_hab = $('.modal-title').data('codhab');
        habitacion.fecha_checkin = $('#fecha_checkin').val();
        habitacion.hora_checkin = $('#hora_checkin').val();
        habitacion.desayuno = $('#desayuno').prop('checked');
        habitacion.adelanto = $('#adelanto').val();
        habitacion.observaciones = $('#observaciones').val();
        lista_habitacion.push(habitacion);
        $( ".collapse").each(function(){ 
          cliente.nit_cliente = $(this).find('#ci_passport').val();
          cliente.rsocial = $(this).find('#nombre_apell').val();
          cliente.nacionalidad = $(this).find('#nacionalidad').val();
          cliente.ciudad = $(this).find('#ciudad').val();
          cliente.empresa = $(this).find('#empresa').val();
          cliente.ecivil = $(this).find('#ecivil').val();
          cliente.email = $(this).find('#email').val();
          cliente.telefono = $(this).find('#telefono').val();
          lista_clientes.push(JSON.stringify(cliente));
        });
        datos_habitacion.push(lista_habitacion);
        datos_habitacion.push(lista_clientes);
        $.ajax({
          url: 'guarda_asignacion',
          data: {data: datos_habitacion},
          type: "POST",
          dataType: "html",
          error: function(response)
          {
              alert('Error al guardar la Asignación!->'. response);
          },
          success: function(response)
          {
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
        var estado_hab = $("input[name='estado_hab']:checked");
        objeto.estado_hab = estado_hab.attr('id');
        datos = JSON.stringify(objeto);
        if (estado_hab.length > 0) {
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
        }
        else{
          alert('Cual es el estado de la Habitación???');
        }
        break;
    case 'chkhab':
        var cod_habitacion = $('.modal-title').data('codhab'),
            reporte = $('#rep_camarera').val(),
            objeto = new Object();
        if (reporte.length > 0) {
          objeto.cod_habitacion = cod_habitacion;
          objeto.reporte = reporte;
          objeto = JSON.stringify(objeto);
          $.ajax({
            url: 'guarda_habilitacion',
            data: {data: objeto},
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
        } else{
          alert('Debes ingresar el reporte!');
        }
        break;
  }
});

$(document).on("click", "#add_people", function(e){
  e.preventDefault();
  var num_personas = $('#num_personas img').length;
  var persona = "<a href='#' id='cli"+ 
                    ++num_personas +
                    "' data-toggle='collapse' data-target='#reg_clients"+ num_personas +"' aria-expanded='false'>"+
                    "<img src='../assets/images/people.png' class='people'>"+
                "</a>"+
                "<a href='#' id='eliminar_persona' data-id='"+ num_personas +"'><span class='badge'>X</span></a>";
  var tabulador = "<div class='collapse well' id='reg_clients"+ num_personas +"' data-cliente="+ num_personas + ">" +
                    "<div class='row'>"+
                      "<div class='col-md-3 form-group'>"+
                        "CI/Pasaporte"+
                        "<input type='text' class='form-control' id='ci_passport' aria-describedby='basic-label_ci_passport' data-cliente="+num_personas+">"+
                      "</div>"+
                      "<div class='col-md-7 form-group'>"+
                        "Nombre y Apellidos "+
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
                        "<input type='text' class='form-control' id='ciudad' aria-describedby='basic-addon3'>"+
                      "</div>"+
                      "<div class='col-md-5 form-group'>"+
                        "Empresa: "+
                        "<input type='text' class='form-control' id='empresa' aria-describedby='basic-addon3'>"+
                      "</div>"+
                      "<div class='col-md-3 form-group'>"+
                        "Estado Civil: "+
                        "<input type='text' class='form-control' id='ecivil' aria-describedby='basic-addon3'>"+
                      "</div>"+
                      "<div class='col-md-5 form-group'>"+
                        "Correo Electrónico: "+
                        "<input type='text' class='form-control' id='email' aria-describedby='basic-addon3'>"+
                      "</div>"+
                      "<div class='col-md-3 form-group'>"+
                        "Teléfono: "+
                        "<input type='text' class='form-control' id='telefono' aria-describedby='basic-addon3'>"+
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
   var nit_cliente = $(this),
        cliente = $(this).data('cliente');
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
                $('#reg_clients'+cliente).find('#nombre_apell').val(item.rsocial);
                $('#reg_clients'+cliente).find('#nacionalidad').val(item.pais);
                $('#reg_clients'+cliente).find('#ciudad').val(item.ciudad);
                $('#reg_clients'+cliente).find('#empresa').val(item.empresa);
                // $('#nacionalidad').val(item.pais);
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
* Desc: Cambia el estado de la habitación: Reservado o Mantenimiento   *
*                         *
*****************************************************/
$(document).on("click", ".dropdown-menu li a", function(){
  var tipo = $.trim($(this).attr('id')),
      codigo = $(this).data('codigo'),
      id_hab = $(this).data('idhab'),
      objeto = new Object();
  objeto.codigo = codigo;
  objeto.id_hab = id_hab;
  objeto = JSON.stringify(objeto);
  $('.modal-body').empty();
  if (tipo == 'chg_reserva') {
    $('.modal-title').text('Reservar Habitación: '+ codigo);
    $('.modal-title').data('codhab', codigo);
    $('.modal-title').data('id_hab', id_hab);
    $("#save_res_mante").data('tipo',tipo);
    $("#save_res_mante").data('idhabresman',codigo);
    $('.modal-body').load('vista_reserva', {data: objeto});
    $("input#id_hab").val(id_hab);
    
  } else if (tipo == 'chg_mantenimiento') {
    $('.modal-title').text('Mantenimiento de Habitación: '+codigo);
    $('.modal-title').data('codhab', codigo);
    $('.modal-title').data('id_hab', id_hab);
    $("#save_res_mante").data('tipo',tipo);
    $("#save_res_mante").data('idhabresman',codigo);
    $('.modal-body').load('vista_mantenimiento', {data: objeto});
    $("input#id_hab").val(id_hab);
  }
});

$(document).on("click", "#save_res_mante", function(e){
  e.preventDefault();
  $("#modal_reserva_mantenimiento form").submit();

});

$(document).on("submit", "#modal_reserva_mantenimiento form", function(e){
  e.preventDefault();
  var donde = $(this).prop('id');
  $.post(donde, $(this).serialize(), function(data){
      var objeto = JSON.parse(data);
      if (objeto.status == 'OK') {
          $('div#error_form_resmante').html(objeto.msg);
          $("#modal_reserva_mantenimiento form").trigger('reset');
      } else if (objeto.status == 'NOK') {
          $('div#error_form_resmante').html(objeto.msg);
      }
  });
});

$(document).on('hide.bs.modal','#modal_reserva_mantenimiento', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('#contenido').load('asignar_habitaciones');
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

$(document).on("click", "#elimina_cliente", function(){
  var objeto = $(this).parents().get(1);
  var id_cliente = $(objeto).attr('id');
  $.ajax({
        url: 'elimina_cliente',
        data: {data: id_cliente},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Eliminar el cliente!');
        },
        success: function(response)
        {
          alert('Cliente Eliminado Correctamente!');
          $(objeto).remove();
        }
  });
});

$(document).on("click","#edita_cliente", function(e){
  e.preventDefault();
  var fila = $(this).parents().get(1);
  var id_cliente = $(fila).attr('id');

  $("#id_cliente").val(id_cliente);
  $('#ed_nombre').val($(fila).find('#nombre_cliente').text());
  $('#ed_num_doc').val($(fila).find('#num_doc_cliente').text());
  $('#ed_pais').val($(fila).find('#pais_cliente').text());
  $('#ed_ciudad').val($(fila).find('#ciudad_cliente').text());
  $('#ed_direccion').val($(fila).find('#direccion_cliente').text());
  $('#ed_telefono').val($(fila).find('#telefono_cliente').text());
});

$(document).on("click", "#guarda_edita_cliente", function(){
  var objeto = new Object();
  objeto.id_cliente = $("#id_cliente").val();
  objeto.nombre_cliente = $('#ed_nombre').val();
  objeto.num_doc_cliente = $('#ed_num_doc').val();
  objeto.pais_cliente = $('#ed_pais').val();
  objeto.ciudad_cliente = $('#ed_ciudad').val();
  objeto.direccion_cliente = $('#ed_direccion').val();
  objeto.telefono_cliente = $('#ed_telefono').val();

  var datos = JSON.stringify(objeto);
  $.ajax({
        url: 'actualiza_cliente',
        data: {data: datos},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Actualizar el cliente!');
        },
        success: function(response)
        {
          alert('Cliente Actualizado Correctamente!');
          $('#contenido').load('gestion_clientes');
        }
  });
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

$(document).on("click", "#abrir_caja", function(){
  $.ajax({
        url: 'trae_monto_cierre',
        //data: {data: datos},
        type: "POST",
        dataType: "html",
        error: function(e)
        {
            alert('Error al Abrir caja!'+e);
        },
        success: function(response)
        {
            var objeto = JSON.parse(response);
            $('#monto_apertura').val(objeto.monto);
            $('#observaciones_apertura').val(objeto.obs);
        }
  });
});

$(document).on("click", "input[type='radio']",function(){
  $('#caja_chica input[type="text"]').prop('disabled',false);
  $('#guarda_mov').prop('disabled',false);
});

$(document).on("click", "#guarda_apertura", function(){
  var objeto = new Object(),
      monto_apertura = $("#monto_apertura").val();
  monto_apertura = monto_apertura.replace(',', '');
  monto_apertura = monto_apertura.replace(',', '');
  objeto.monto = monto_apertura;
  objeto.obs = $("#observaciones_apertura").val();
  var datos = JSON.stringify(objeto);
  $.ajax({
        url: 'apertura_caja',
        data: {data: datos},
        type: "POST",
        dataType: "html",
        error: function(e)
        {
            alert('Error al Abrir caja!'+e);
        },
        success: function(response)
        {
            alert("Caja Abierta Correctamente");
            $('#estado_caja').html('<button class="btn btn-primary" style="color: #fff;font-weight:bold;" id="caja">Caja ABIERTA!</button>');
            $('#contenido').load('vista_caja');
        }
  });
});

$(document).on("click", "#guarda_mov", function(){
  var tipo = $('input[type="radio"]:checked').prop('id'),
      monto = $("#monto"),
      id_estado_caja = $("#id_estado_caja"),
      tipo_doc = $("#tipo_doc"),
      num_doc = $("#num_doc"),
      concepto = $("#concepto"),
      objeto = new Object();
  
  if (monto.val().length > 0 && tipo_doc.val().length > 0 && num_doc.val().length > 0 && concepto.val().length > 0) {
      objeto.id_estado_caja = id_estado_caja.val();
      objeto.tipo = tipo;
      objeto.monto = monto.val();
      objeto.tipo_doc = tipo_doc.val();
      objeto.num_doc = num_doc.val();
      objeto.concepto = concepto.val();
      var datos = JSON.stringify(objeto);
      $.ajax({
            url: 'guarda_mov_caja',
            data: {data: datos},
            type: "POST",
            dataType: "html",
            error: function(e)
            {
                alert('Error al Guardar Movimiento de caja! -> '+e);
            },
            success: function(response)
            {
                alert("Movimiento guardado Correctamente");
                var cadena = '<tr><td>1</td><td>'
                              + tipo
                              +'</td><td>'
                              + tipo_doc.val()
                              +'</td><td>'
                              + num_doc.val()
                              +'</td><td>'
                              + concepto.val()
                              +'</td><td>'
                              + monto.val()
                              +'</td></tr>';
                $('#detalle_mov table tbody').append(cadena);
                var total_caja = $("#total_caja").text();
                total_caja = total_caja.replace(',', '');
                total_caja = total_caja.replace(',', '');
                if (tipo == 'ingreso') {
                  total_caja = parseFloat(total_caja) + parseFloat( monto.val() );
                } else{
                  total_caja = parseFloat(total_caja) - parseFloat( monto.val() );
                }

                $("#total_caja").text(number_format(total_caja,2) );
                tipo_doc.val('');
                num_doc.val('');
                monto.val('');
                concepto.val('');
            }
      });
  } else {
    alert('Existen campos vacios!!!');
  }
});

$(document).on("click","#cerrar_caja", function(){
  var monto_total = $("#total_caja").text();
  $("#monto_cierre").val(monto_total);
});

$(document).on("click", "#guarda_cierre",function(){
  var monto_cierre = $("#monto_cierre").val();
  monto_cierre = monto_cierre.replace(',', '');
  monto_cierre = monto_cierre.replace(',', '');
  var objeto = new Object();
  objeto.monto_cierre = monto_cierre;
  objeto.obs_cierre = $("#observaciones_cierre").val();
  var datos = JSON.stringify(objeto);
  $.ajax({
        url: 'cierre_caja',
        data: {data: datos},
        type: "POST",
        dataType: "html",
        error: function(e)
        {
            alert('Error al Cerrar caja!'+e);
        },
        success: function(response)
        {
            alert("Caja Cerrada Correctamente");
            $('#estado_caja').html('<button class="btn btn-danger" style="color: #fff;font-weight:bold;" id="caja">Caja CERRADA!</button>');
            $('#frm_pdf_cierre_caja').submit();
            $('#contenido').load('vista_caja');
        }
  });
});

$(document).on("click", "#imprime_mov_caja", function(){
  $('#frm_pdf_cierre_caja').submit();
});

$(document).on("click","#imprimeCaja", function(e){
  e.preventDefault();
  $('#frm_pdf_caja').submit();
});

$(document).on("click", "#busca_cierre", function(){
  if ($("#fch_bus_cierre").val().length > 0) {
    var objeto = new Object(),
        fch_cierre = $("#fch_bus_cierre").val();
    objeto.fch_cierre = fch_cierre;
    objeto = JSON.stringify(objeto);
    $.ajax({
          url: 'busca_cierre_caja',
          data: {data: objeto},
          type: "POST",
          dataType: "html",
          error: function(e)
          {
              alert('Error al traer Cierres de caja!'+e);
          },
          success: function(response)
          {
              $("#abrir_caja, #cerrar_caja").css("display","none");
              $('#detalle_mov').html(response);
          }
    });
  } else {
    alert('Ingrece una fecha para buscar');
  }
});

$(document).on("click", "#detalle_cierre_cja tbody tr", function(){
  $.ajax({
        url: 'trae_detalle_cierre_cja',
        data: {data: $(this).attr("id")},
        type: "POST",
        dataType: "html",
        error: function(e)
        {
            alert('Error al traer Cierres de caja!'+e);
        },
        success: function(response)
        {
            $('#detalle_mov_cierre_cja').html(response);
        }
  });
});

/****************************************************
*                         *
*           Sección de Reportes                     *
*                         *
*****************************************************/
$(document).on("click","#reportes",function(e){
  e.preventDefault();
  $('#contenido').load('vista_reportes');
  menuClose();
});

$(document).on('keyup',"#habitacion", function(e){
  if (e.which == 13) 
  {
    var valor = $(this).val();
    $("#contenido").load("busca_hab_rep", {buscar: valor});
    $('#h_cod_hab').val(valor);
   }

});

$(document).on("click","#imprimeReport", function(e){
  e.preventDefault();
  $('#frm_pdf_report').submit();
});

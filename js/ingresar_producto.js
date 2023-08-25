// function AbrirModalRegistro(){
//     $("#modal_registro").modal({backdrop: 'static', keyboard : false})
//     $("#modal_registro").modal('show')
// }


// function btnregistrar() {
//     let nombre = $('#nombre').val();
//     let descripcion = $('#descripcion').val();
//     let precio = $('#precio').val();
//     let existencia = $('#existencia').val()

//     if(nombre.length==0 || descripcion.length == 0 || precio.length == 0 || existencia.length == 0){
//         return alert("Porfavor llenar campos vacíos.")
//     }
//     let data = {
//         nombre: nombre,
//         descripcion: descripcion,
//         precio: precio,
//         existencia: existencia
//     };
//     $.ajax({
//         url: './controllers/agregar_producto.php',
//         type: 'POST',
//         data: data,
//     }).done(function(resp){
//         if(resp>0){
//             if(resp==1){
//                 $('#modal').modal('hide');
//                 alert("CONFRIMADO PRODUCTO AGREGADO")
//                 .then((value)=>{
//                     LimpiarRegistro();
//                     table.ajax.reload();
//                 }); 
//             }else{
//                 alert("ERROR");
//             }
//         }else{  
//             alert("ERROR");
//         }
//     })
// }

// function LimpiarRegistro(){
//     $('#nombre').val("");
//     $('#descripcion').val("");
//     $('#precio').val("");
//     $('#existencia').val("");
// }
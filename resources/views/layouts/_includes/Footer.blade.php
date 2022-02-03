 <!-- container-scroller -->
 <!-- plugins:js -->

 <!-- endinject -->
 <!-- Plugin js for this page-->
 <script src="/admin/vendors/chart.js/Chart.min.js"></script>
 <!-- End plugin js for this page-->
 <!-- inject:js -->
 {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}

  <script src="/js/datatables/jquery-3.5.1.js"></script>
  <script src="/js/sweetalert2.all.min.js"></script>
  <script src='/js/datatables/jquery.dataTables.min.js'></script>
     <script src='/js/datatables/dataTables.bootstrap4.min.js'></script>
  <script>
      $('#dataTable-1').DataTable({
          autoWidth: true,
          "lengthMenu": [
              [16, 32, 64, -1],
              [16, 32, 64, "All"]
          ]
      });
  </script>

 {{-- <script>
     $('.editar').click(function(e) {
         $('#tr' + this.id).find('td').each(function(i) {
             var test = "" + $(this).text().trim();
             $(this).empty();
             $(this).html('<input type="text" class="w-100" name="' + variaveis()[i] + '" value="' +
                 test +
                 '"   placeholder="CodProduto">');
         });
         $('#tr' + this.id + ' td:last').html(
             '<input class="btn btn-primary mr-2 " onclick="editar(' + this.id +
             ')" type="button"value="Submeter">');
         console.log($('#tr td:last').html());

     });
 </script> --}}
{{-- 
 <script>
     $("td").click(function() {
         var id = $(this).closest("tr").prop("id").replace('tr', '');
         var campo = $(this).prop('id');

         if (campo != 'genero' + id) {
             var td = $(this);
             // console.log(campo);
             var valor_actual = $(this).text().trim();
             //  console.log(valor_actual);
             if ((this).querySelector('input') == null) {
                 $(this).empty();
                 var tag = "input";
                 $(this).append('<input type="text" class="w-100" name="' + campo + '" value="' +
                     valor_actual +
                     '"placeholder="Digita o valor"> <small onclick="actualizar(\'' + id + '\',\'' + campo +
                     '\',\'' + tag +
                     '\')"><img  style="width: 20%;height: 22px " src="/admin/up.png"></small> ');
             }
         } else {
             var tag = "select";
             if ((this).querySelector('select') == null) {
                 $(this).empty();
                 $(this).append('<select class="" name="' + campo +
                     '" id="exampleSelectGender"> <option value="Masculino">Masculino</option><option value="Feminino">Feminino</option></select><small onclick="actualizar(\'' +
                     id + '\',\'' + campo + '\',\'' + tag +
                     '\')"><img  style="width: 20%;height: 22px " src="/admin/up.png"></small>');

             }
         }
     });

     function actualizar(id, campo, tag) {
         // texto= $(this).text();
          var coluna=campo.replace('tr_', '').replace(''+id, '');
         var novo_valor = $(tag + '[name=' + campo + ']').val();
       
  
          console.log(id,coluna,novo_valor);
               $.ajax({
                  url: '/admin/utilizadores/atualizar2/' + id + '/' + coluna + '/' + novo_valor,

                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  type: "PUT",

                  success: function(response) {
                   //  var id=
               $('#'+campo).empty().html(response.valor);
                      if (response.estado == true) {
                          Swal.fire(
                              'Utilizador cadastrado com sucesso',
                              '',
                              'success'
                          );


                      }



                  }
              });


         // var id = $("small").closest("tr").prop("id").replace('tr', '');
     }



     //  var form = $('#form_tr_editar').serialize();
     //  $.ajax({
     //         url:'/admin/utilizadores/atualizar/'+id+'/,

     //         headers: {
     //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     //         },
     //         type: "POST",
     //         data: form,
     //         success: function(response) {

     //            if(response.estado==true){
     //             Swal.fire(
     //     'Utilizador cadastrado com sucesso',
     //     '',
     //     'success'
     // ); 
     // $('#tr'+id).empty();
     // $('#tr'+id).append($('<td class="py-1">').append(
     //                     ' <img src="/admin/images/faces/face7.jpg" alt="image" />'))
     //                 .append($('<td onclick="pegarTexto('+ response.utilizador.nome+')">').append(''+ response.utilizador.nome))
     //                     .append($('<td>').append(''+ response.utilizador.primeiro_nome))
     //                         .append($('<td>').append(''+ response.utilizador.ultimo_nome))
     //                             .append($('<td>').append(''+ response.utilizador.email))
     //                                 .append($('<td>').append(''+ response.utilizador.telefone))
     //                                   .append($('<td>').append(''+ response.utilizador.genero))
     //                                     .append($('<td>').append(''+ response.utilizador.tipoUtilizador))
     //                 .append($('<td>').append(
     //                     '<div class="progress"><div class="progress-bar bg-warning" role="progressbarstyle="width: 20%" aria-valuenow="20" aria-valuemin="0"aria-valuemax="100"></div></div>'
     //                     ))

     //                     .append($('<td>').append('<div class="btn-group-vertical"role="group" aria-label="Basic example"><div class="btn-group"><button type="button"class="btn btn-outline-secondary btn-sm dropdown-toggle"data-toggle="dropdown">Dropdown</button>   <div class="dropdown-menu"><a class="dropdown-item editar"  id="'+id+'">Editar</a><a class="dropdown-item">Delete</a><a class="dropdown-item editar">Swap</a> </div></div> </div>'));


     //  }



     //         },
     //         // error: function(error) {
     //         //     console.log(error);
     //         // }
     //     });



     function variaveis() {
         return new Array(
             'profile_photo_path',
             'nome',
             'primeiro_nome',
             'ultimo_nome',
             'email',
             'telefone',
             'genero',
             'tipoUtilizador',

         );
     }
 </script> --}}
 <!-- endinject -->
 <!-- Custom js for this page-->
 <script src="/admin/js/chart.js"></script>
 <script src="/admin/vendors/base/vendor.bundle.base.js"></script>
 
 <!-- endinject -->
 <!-- Plugin js for this page-->
 <!-- End plugin js for this page-->
 <!-- inject:js -->
 <script src="/admin/js/off-canvas.js"></script>
 <script src="/admin/js/hoverable-collapse.js"></script>
 <script src="/admin/js/template.js"></script>
 <script src="/admin/js/todolist.js"></script>
 <!-- endinject -->
 <!-- Custom js for this page-->
 <!-- End custom js for this page-->
<script>
      $(document).ready(function() {

//start delete
$('a[data-confirm]').click(function(ev) {
    var href = $(this).attr('href');
    if (!$('#confirm-delete').length) {
        $('table').append(
            '<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"> <div class="modal-header"> <h5 class="modal-title" id="exampleModalLabel">Eliminar os dados</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza que pretende eliminar?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> <a  class="btn btn-info" id="dataConfirmOk">Eliminar</a> </div></div></div></div>'
        );
    }
    $('#dataConfirmOk').attr('href', href);
    $('#confirm-delete').modal({
        shown: true
    });
    return false;

});
//end delete
});
</script>
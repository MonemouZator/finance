
  <!-- Header -->
<?php require_once("../../inc/header.php");  ?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar horzontale -->
  <?php require_once("../../inc/navbarh.php");  ?>
  <!-- /.navbar -->

  <!-- Navbar Verticale -->
  <?php require_once("../../inc/navbarv.php");  ?>
  <!-- header container-->
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Gestion Users :</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Page User</li>
            </ol>
          </div>
        </div>
      </div>
    </div>


   <!-- contenue container-->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- Liste -->
          <div class="col-lg-12">
            <div class="card">
                    <div class="card-header">
                          <h5 class="m-0">La Liste Des Users :
                          <button class='btn btn-sm btn-danger' data-id='' data-toggle='modal' data-target='#insertModal' >Nouveau User</button>
                    </div></h5>
                    <div class="card-body">
                          <table id="userTable" class="table table-dark table-bordered table-striped" width="100%">
                              <thead>
                              <tr>

                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Genre</th>
                                    <th>Ville</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                              </tr>
                              </thead>

                            </table>
                    </div>
            </div>
             <!-- Modal update -->
             <div id="updateModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content bg-primary">
                        <div class="modal-header">
                            <h4 class="modal-title">Formulaire User :</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" >Nom User :</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Nom User" required>
                            </div>
                            <div class="form-group">
                                <label for="email" >Email User :</label>
                                <input type="email" class="form-control" id="email"  placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="gender" >Genre User :</label>
                                <select id='gender' class="form-control">
                                    <option value='male'>Male</option>
                                    <option value='female'>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city" >Ville User :</label>
                                <input type="text" class="form-control" id="city"  placeholder="Enter city">
                            </div>
                            <div class="form-group">
                                <label for="gender" >Statut User :</label>
                                <select id='Statut' class="form-control">
                                    <option value=''>Seectionner Statut</option>

                                </select>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <input type="hidden" id="txt_userid" value="0">
                            <button type="button" class="btn btn-outline-light btn-sm" id="btn_save">Sauvgarder</button>
                            <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Modal Insert -->
        <div id="insertModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content bg-danger">
                        <div class="modal-header">
                            <h4 class="modal-title">Nouveau User :</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" >Nom User :</label>
                                <input type="text" class="form-control" id="nameI" placeholder="Enter Nom User" required>
                            </div>
                            <div class="form-group">
                                <label for="email" >Email User :</label>
                                <input type="email" class="form-control" id="emailI"  placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="gender" >Genre User :</label>
                                <select id='genderI' class="form-control">
                                    <option value='male'>Male</option>
                                    <option value='female'>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city" >Ville User :</label>
                                <input type="text" class="form-control" id="cityI"  placeholder="Enter city">
                            </div>
                            <div class="form-group">
                                <label for="statut" >Statut User :</label>
                                <select id='IdstatutI' class="form-control">
                                    <option value=''>Seectionner Statut</option>

                                </select>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">

                            <button type="button" class="btn btn-outline-light btn-sm" id="btninsert">Sauvgarder</button>
                            <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Table -->



        </div>


      </div>
    </div>

  </div>


  <!-- Control Sidebar -->
  <?php require_once("../../inc/controle.php");  ?>


  <!-- Footer -->
  <?php require_once("../../inc/footer.php");  ?>
</div>


<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Page specific script -->
<!-- Controleur -->
<script>

        $(document).ready(function(){
          remplirListeStatuts();
          var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
      // DataTable
         var userDataTable = $('#userTable').DataTable({
                'processing': true,
                "responsive": true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'Userdata.php'
                },
                'columns': [
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'gender' },
                    { data: 'city' },
                    { data: 'libelle' },
                    { data: 'action' },
                ]

            });


            // Afficher enregistrement
            $('#userTable').on('click','.updateUser',function(){
                var id = $(this).data('id');

                $('#txt_userid').val(id);

                // AJAX REPONSE
                $.ajax({
                    url: 'Userdata.php',
                    type: 'post',
                    data: {request: 2, id: id},
                    dataType: 'json',
                    success: function(response){
                        if(response.status == 1){

                            $('#name').val(response.data.name);
                            $('#email').val(response.data.email);
                            $('#gender').val(response.data.gender);
                            $('#city').val(response.data.city);

                        }
                        else{
                            alert("Invalid ID.");
                        }
                    }
                });

            });


            // Sauvegarder les modification user
            $('#btn_save').click(function(){
                var id = $('#txt_userid').val();

                var name = $('#name').val().trim();
                var email = $('#email').val().trim();
                var gender = $('#gender').val().trim();
                var city = $('#city').val().trim();

                if(name !='' && email != '' && city != ''){

                    // AJAX reponse
                    $.ajax({
                        url: 'Userdata.php',
                        type: 'post',
                        data: {request: 3, id: id,name: name, email: email, gender: gender, city: city},
                        dataType: 'json',
                        success: function(response){
                            if(response.status == 1){
                                alert(response.message);

                                // Vider les Champs
                                $('#name','#email','#city').val('');
                                $('#gender').val('male');
                                $('#txt_userid').val(0);

                                // Recharger DataTable
                                userDataTable.ajax.reload();

                                // Fermer modal
                                $('#updateModal').modal('toggle');
                            }else{
                                alert(response.message);
                            }
                        }
                    });

                }else{
                    alert('Merci de compléter tous les champs.');
                }
            });



            // Nouveau user
        $('#btninsert').click(function(){


          var name = $('#nameI').val().trim();
            var email = $('#emailI').val().trim();
            var gender = $('#genderI').val().trim();
            var city = $('#cityI').val().trim();
            var Idstatut = $('#IdstatutI').val().trim();
            alert("salut");
            if(name !='' && email != '' && city != ''){

            // AJAX reponse
            $.ajax({
                url: 'Userdata.php',
                type: 'post',
                data: {request: 5,name: name, email: email, gender: gender, city: city, Idstatut: Idstatut},
                dataType: 'json',
                success: function(response)
                {
                    if(response.status == 1)
                    {
                        alert(response.message);

                        // Vider les Champs
                        $('#nameI','#emailI','#cityI').val('');
                        $('#genderI').val('male');


                        // Recharger DataTable
                        userDataTable.ajax.reload();

                        // Fermer modal
                        $('#insertModal').modal('toggle');
                  }
                 else
                   {
                      alert(response.message);
                   }
                }
            });

            }
             else
            {
                 alert('Merci de compléter tous les champs.');
            }


        });


            // Delete record
            $('#userTable').on('click','.deleteUser',function(){
                var id = $(this).data('id');

                var deleteConfirm = confirm("voulez vous vraiment supprimer cet Utilisateur ?");
                if (deleteConfirm == true) {
                    // AJAX request
                    $.ajax({
                        url: 'Userdata.php',
                        type: 'post',
                        data: {request: 4, id: id},
                        success: function(response){

                            if(response == 1){
                               // alert("Utilisateur supprimé avec succés.");
                                Toast.fire({
                                icon: 'error',
                 title: 'Utilisateur supprimé avec succés.'
                        });
                                // Recharger DataTable
                                userDataTable.ajax.reload();
                            }else{
                                alert("Id invalide.");
                            }

                        }
                    });
                }

            });

          });
                    function remplirListeStatuts() {
                      $.ajax({
                      url: 'Userdata.php',
                      type: 'post',
                      data: {request: 6},
                      dataType: 'json',
                      success: function(response){

                        var len = response.length;

                        for( var i = 0; i<len; i++){
                          var id = response[i]['Idstatut'];
                          var name = response[i]['libelle'];

                          $("#IdstatutI").append("<option value='"+id+"'>"+name+"</option>");

                        }
                      }
                   });


                       }

        </script>

</body>
</html>

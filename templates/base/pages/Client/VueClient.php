  
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
            <h1 class="m-0">Client :</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Page Client</li>
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
                          <h5 class="m-0">La Liste Des Clients :
                          <button class='btn btn-sm btn-danger' data-id='' data-toggle='modal' data-target='#insertModal' >Nouveau client</button>
                    </div></h5>
                    <div class="card-body">
                          <table id="clientTable" class="table table-dark table-bordered table-striped" width="100%">
                              <thead>
                              <tr>
                                    <th>nom</th>
                                    <th>prenom</th>
                                    <th>adresse</th>
                                    <th>telephone</th>
                                    <th>DateNai</th>
                                    <th>email</th>
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
                            <h4 class="modal-title">Formulaire Client :</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nom" >Nom  :</label>
                                <input type="text" class="form-control" id="nom" placeholder="Enter nom " required>
                            </div>
                            <div class="form-group">
                                <label for="prenom" >Prenom :</label>
                                <input type="text" class="form-control" id="prenom"  placeholder="Enter prenom">
                            </div>
                            <div class="form-group">
                                <label for="adresse" >Adresse :</label>
                                <input type="text" class="form-control" id="adresse"  placeholder="Enter adresse">
                            </div>
                            <div class="form-group">
                                <label for="telephone" >Telephone :</label>
                                <input type="text" class="form-control" id="telephone"  placeholder="Enter telephone">
                            </div>
                            <div class="form-group">
                                <label for="DateNai" >Date Naissance:</label>
                                <input type="Date" class="form-control" id="DateNai"  placeholder="Enter DateNai">
                            </div>
                            <div class="form-group">
                                <label for="email" >Email :</label>
                                <input type="text" class="form-control" id="email"  placeholder="Enter email">
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
                            <h4 class="modal-title">Nouveau Client :</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nom" >Nom  :</label>
                                <input type="text" class="form-control" id="nomI" placeholder="Enter Nom " required>
                            </div>
                            <div class="form-group">
                                <label for="prenom" >Prenom  :</label>
                                <input type="text" class="form-control" id="prenomI"  placeholder="Enter Prenom">
                            </div>
                          
                            <div class="form-group">
                                <label for="adresse" >Adresse :</label>
                                <input type="text" class="form-control" id="adresseI"  placeholder="Enter Adresse">
                            </div>
                            <div class="form-group">
                                <label for="telephone" >Telephone :</label>
                                <input type="text" class="form-control" id="telephoneI"  placeholder="Enter Telephone">
                            </div>
                            <div class="form-group">
                                <label for="DateNai" >Date Naissance :</label>
                                <input type="Date" class="form-control" id="DateNaiI"  placeholder="Enter Date Naissance">
                            </div>
                         
                            <div class="form-group">
                                <label for="email" >Email :</label>
                                <input type="text" class="form-control" id="emailI"  placeholder="Enter Email">
                            </div>
                          

                        </div>
                        <div class="modal-footer justify-content-between">

                            <button type="button" class="btn btn-outline-light btn-sm" id="btn_insert">Sauvgarder</button>
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
      // DataTable
         var ClientDataTable = $('#clientTable').DataTable({
                'processing': true,
                "responsive": true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'ClientData.php'
                },
                'columns': [
                    { data: 'nom' },
                    { data: 'prenom' },
                    { data: 'adresse' },
                    { data: 'telephone' },
                    { data: 'DateNai' },
                    { data: 'email' },
                   
                    { data: 'action' },
                ]

            });


            // Afficher enregistrement
            $('#clientTable').on('click','.updateclient',function(){
                var id = $(this).data('id');
              //  alert(id);

                $('#txt_userid').val(id);

                // AJAX REPONSE
                $.ajax({
                    url: 'ClientData.php',
                    type: 'post',
                    data: {request: 2, id: id},
                    dataType: 'json',
                    success: function(response){
                        if(response.status == 1){

                            $('#nom').val(response.data.nom);
                            $('#prenom').val(response.data.prenom);
                            $('#adresse').val(response.data.adresse);
                            $('#telephone').val(response.data.telephone);
                            $('#DateNai').val(response.data.DateNai);
                            $('#email').val(response.data.email);
                           
                          
                        }
                        else{
                            alert("Invalid ID.");
                        }
                    }
                });

            });


            // Sauvegarder les modification client
            $('#btn_save').click(function(){
                var Id = $('#txt_userid').val();

                var nom = $('#Nom').val().trim();
                var prenom = $('#Prenom').val().trim();
                var adresse = $('#Adresse').val().trim();
                var telephone = $('#Telephone').val().trim();
                var DateNai = $('#Date Naissance').val().trim();
                var email = $('#Email').val().trim();
                

                if(nom !='' && prenom != '' && adresse != ''&& telephone != ''&& DateNai != '' && email != ''){

                    // AJAX reponse
                    $.ajax({
                        url: 'ClientData.php',
                        type: 'post',
                        data: {request: 3, Id: Id,nom: nom, prenom: prenom, adresse: adresse, telephone: telephone, DateNai: DateNai, email: email},
                        dataType: 'json',
                        success: function(response){
                            if(response.status == 1){
                                alert(response.message);

                                // Vider les Champs
                                $('#Nom','#Prenom','#Adresse','#Telephone','#Date Naissance','#Email').val('');
                               
                                $('#txt_userid').val(0);

                                // Recharger DataTable
                                ClientDataTable.ajax.reload();

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


            // Delete record
            $('#clientTable').on('click','.deleteclient',function(){
                var id = $(this).data('id');

                var deleteConfirm = confirm("voulez vous vraiment supprimer cet Utilisateur ?");
                if (deleteConfirm == true) {
                    // AJAX request
                    $.ajax({
                        url: 'ClientData.php',
                        type: 'post',
                        data: {request: 4, Id: Id},
                        success: function(response){

                            if(response == 1){
                                alert("Utilisateur supprimé avec succés.");

                                // Recharger DataTable
                               ClientDataTable.ajax.reload();
                            }else{
                                alert("Id invalide.");
                            }

                        }
                    });
                }

            });


            // Nouveau client
            $('#btn_insert').click(function(){


                var nom = $('#nomI').val().trim();
                var prenom = $('#prenomI').val().trim();
                var adresse = $('#adresseI').val().trim();
                var telephone = $('#telephoneI').val().trim();
                var DateNai = $('#DateNaiI').val().trim();
                var email = $('#emailI').val().trim();
                
                if(nom !='' && prenom != '' && adresse != '' && telephone != '' && DateNai != '' && email != '' ){

                    // AJAX reponse
                    $.ajax({
                        url: 'ClientData.php',
                        type: 'post',
                        data: {request: 5,nom: nom, prenom: prenom, adresse: adresse, telephone: telephone, DateNai: DateNai, email: email},
                        dataType: 'json',
                        success: function(response){
                            if(response.status == 1){
                                alert(response.message);

                                // Vider les Champs
                                $('#Nom','#Prenom','#Adresse','#Telephone','#Date Naissance','#Email').val('');
                               


                                // Recharger DataTable
                                ClientDataTable.ajax.reload();

                                // Fermer modal
                                $('#insertModal').modal('toggle');
                            }else{
                                alert(response.message);
                            }
                        }
                    });

                }else{
                    alert('Merci de compléter tous les champs.');
                }
            });



                    });
        </script>

</body>
</html>
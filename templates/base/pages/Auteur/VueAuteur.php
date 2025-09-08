
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
            <h1 class="m-0">Auteur :</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Page Auteur</li>
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
                          <h5 class="m-0">La Liste Auteur :
                          <button class='btn btn-sm btn-danger' data-id='' data-toggle='modal' data-target='#insertModal' >Nouveau Auteur</button>
                    </div></h5>
                    <div class="card-body">
                          <table id="auteurTable" class="table table-dark table-bordered table-striped" width="100%">
                              <thead>
                              <tr>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Telephone</th>
                                    <th>Email</th>
                                    <th>Adresse</th>
                                    <th>Date Naissance</th>
            
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
                            <h4 class="modal-title">Formulaire Auteur :</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nom" >Nom  :</label>
                                <input type="text" class="form-control" id="nom" placeholder="Enter Nom " required>
                            </div>
                            <div class="form-group">
                                <label for="prenom" >Prenom :</label>
                                <input type="text" class="form-control" id="prenom"  placeholder="Enter Prenom">
                            </div>
                            <div class="form-group">
                                <label for="telephone" >Telephone :</label>
                                <input type="text" class="form-control" id="telephone"  placeholder="Enter Telephone">
                            </div>
                            <div class="form-group">
                                <label for="email" >Email :</label>
                                <input type="text" class="form-control" id="email"  placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="adtesse" >Adresse:</label>
                                <input type="text" class="form-control" id="adresse"  placeholder="Enter Adresse">
                            </div>
                            <div class="form-group">
                                <label for="datenaissance" >Date Naissance :</label>
                                <input type="Date" class="form-control" id="datenaissance"  placeholder="Enter Date Naissance">
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
                            <h4 class="modal-title">Nouveau Auteur :</h4>
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
                                <label for="telephon" >Telephone :</label>
                                <input type="text" class="form-control" id="telephoneI"  placeholder="Enter Telephone">
                            </div>
                            <div class="form-group">
                                <label for="email" >Email :</label>
                                <input type="text" class="form-control" id="emailI"  placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="adtesse" >Adresse :</label>
                                <input type="text" class="form-control" id="adresseI"  placeholder="Enter Adresse">
                            </div>
                         
                            <div class="form-group">
                                <label for="datenaissanec" >Date Naissance :</label>
                                <input type="Date" class="form-control" id="datenaissanceI"  placeholder="Enter Date Naissance">
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
         var AuteurDataTable = $('#auteurTable').DataTable({
                'processing': true,
                "responsive": true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'AuteurData.php'
                },
                'columns': [
                    { data: 'Nom' },
                    { data: 'Prenom' },
                    { data: 'Telephone' },
                    { data: 'Email' },
                    { data: 'Adresse' },
                    { data: 'Date Naissance' },
                    
                    { data: 'action' },
                ]

            });


            // Afficher enregistrement
            $('#auteurTable').on('click','.updateauteur',function(){
                var IdAuteur = $(this).data('id');
              //  alert(IdAuteur);

                $('#txt_userid').val(IdAuteur);

                // AJAX REPONSE
                $.ajax({
                    url: 'AuteurData.php',
                    type: 'post',
                    data: {request: 2, IdAuteur: IdAuteur},
                    dataType: 'json',
                    success: function(response){
                        if(response.status == 1){

                            $('#nom').val(response.data.nom);
                            $('#prenom').val(response.data.prenom);
                            $('#telephone').val(response.data.telephone);
                            $('#email').val(response.data.email);
                            $('#adresse').val(response.data.adresse);
                            $('#datenaissance').val(response.data.datenaissance);
                            
                          
                        }
                        else{
                            alert("Invalid ID.");
                        }
                    }
                });

            });


            // Sauvegarder les modification auteur
            $('#btn_save').click(function(){
                var IdAuteur = $('#txt_userid').val();

                var nom = $('#nom').val().trim();
                var prenom = $('#prenom').val().trim();
                var telephone = $('#telephone').val().trim();
                var email = $('#email').val().trim();
                var adresse = $('#adresse').val().trim();
                var datenaissance = $('#datenaissance').val().trim();
                

                if(nom !='' && prenom != '' && telephone != ''&& email != ''&& adresse != '' && datenaissance != ''){

                    // AJAX reponse
                    $.ajax({
                        url: 'AuteurData.php',
                        type: 'post',
                        data: {request: 3, IdAuteur: IdAuteur,nom: nom, prenom: prenom, telephone: telephone, email: email, adresse: adresse, datenaissance: datenaissance},
                        dataType: 'json',
                        success: function(response){
                            if(response.status == 1){
                                alert(response.message);

                                // Vider les Champs
                                $('#nom','#prenom','#telephone','#email','#adresse','#datenaissance').val('');
                               
                                $('#txt_userid').val(0);

                                // Recharger DataTable
                                AuteurDataTable.ajax.reload();

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
            $('#auteurTable').on('click','.deleteauteur',function(){
                var IdAuteur = $(this).data('id');

                var deleteConfirm = confirm("voulez vous vraiment supprimer cet Utilisateur ?");
                if (deleteConfirm == true) {
                    // AJAX request
                    $.ajax({
                        url: 'AuteurData.php',
                        type: 'post',
                        data: {request: 4, IdAuteur: IdAuteur},
                        success: function(response){

                            if(response == 1){
                                alert("Utilisateur supprimé avec succés.");

                                // Recharger DataTable
                               AuteurDataTable.ajax.reload();
                            }else{
                                alert("Id invalide.");
                            }

                        }
                    });
                }

            });


            // Nouveau auteur
            $('#btn_insert').click(function(){


                var nom = $('#nomI').val().trim();
                var prenom = $('#prenomI').val().trim();
                var telephone = $('#telephoneI').val().trim();
                var email = $('#emailI').val().trim();
                var adresse = $('#adresseI').val().trim();
                var datenaissance = $('#datenaissanceI').val().trim();
                

                if(nom !='' && prenom != '' && telephone != '' && email != '' && adresse != '' && datenaissance != ''){

                    // AJAX reponse
                    $.ajax({
                        url: 'AuteurData.php',
                        type: 'post',
                        data: {request: 5,nom: nom, prenom: prenom, telephone: telephone, email: email, adresse: adresse, datenaissance: datenaissance},
                        dataType: 'json',
                        success: function(response){
                            if(response.status == 1){
                                alert(response.message);

                                // Vider les Champs
                                $('#Nom','#Prenom','#Telephone','#Email','#Adresse','#Date Naissance').val('');
                               


                                // Recharger DataTable
                                AuteurDataTable.ajax.reload();

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
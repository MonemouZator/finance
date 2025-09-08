
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
            <h1 class="m-0">Maison Edition :</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Page Maison Edition</li>
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
                          <h5 class="m-0">La Liste maison edition:
                          <button class='btn btn-sm btn-danger' data-id='' data-toggle='modal' data-target='#insertModal' >Nouveau maison edition</button>
                    </div></h5>
                    <div class="card-body">
                          <table id="maisoneditionTable" class="table table-dark table-bordered table-striped" width="100%">
                              <thead>
                              <tr>
                                    <th>date_edition</th>
                              <th>genre</th>
            
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
                            <h4 class="modal-title">Formulaire Maison Edition :</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="date_edition" >Date Edition  :</label>
                                <input type="Date" class="form-control" id="dateedition" placeholder="Enter Date Edition " required>
                            </div>
                            <div class="form-group">
                                <label for="genre" >Genre :</label>
                                <input type="text" class="form-control" id="genre" placeholder="Enter Genre " required>
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
                            <h4 class="modal-title">Nouveau Maison Edition :</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="date_edition" >Date Edition  :</label>
                                <input type="Date" class="form-control" id="dateI" placeholder=" Date Edition " required>
                            </div>
                            <div class="form-group">
                                <label for="genre" >Genre :</label>
                                <input type="text" class="form-control" id="genreI" placeholder=" Genre " required>
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
         var MaisonEditionDataTable = $('#maisoneditionTable').DataTable({
                'processing': true,
                "responsive": true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'MaisonEditionData.php'
                },
                'columns': [
                    { data: 'date_edition' },
                    { data: 'genre' },
                    
                    { data: 'action' },
                ]

            });


            // Afficher enregistrement
            $('#maisoneditionTable').on('click','.updatemaisonedition',function(){
                var id_maison_edition = $(this).data('id');
              //  alert(id_maison_edition);

                $('#txt_userid').val(id_maison_edition);

                // AJAX REPONSE
                $.ajax({
                    url: 'MaisonEditionData.php',
                    type: 'post',
                    data: {request: 2, id_maison_edition: id_maison_edition},
                    dataType: 'json',
                    success: function(response){
                        if(response.status == 1){

                            $('#date_edition').val(response.data.date_edition);
                            $('#genre').val(response.data.genre);
                            
                          
                        }
                        else{
                            alert("Invalid ID.");
                        }
                    }
                });

            });


            // Sauvegarder les modification Maison edition
            $('#btn_save').click(function(){
                var id_maison_edition = $('#txt_userid').val();

                var date_edition = $('#date_edition').val().trim();
                
                var genre = $('#genre').val().trim();

                if(date_edition!='' && genre!=''){

                    // AJAX reponse
                    $.ajax({
                        url: 'MaisonEditionData.php',
                        type: 'post',
                        data: {request: 3, id_maison_edition: id_maison_edition,date_edition: date_edition, genre: genre},
                        dataType: 'json',
                        success: function(response){
                            if(response.status == 1){
                                alert(response.message);

                                // Vider les Champs
                                $('#date_edition').val('');
                                $('#genre').val('');
                                $('#txt_userid').val(0);

                                // Recharger DataTable
                                MaisonEditionDataTable.ajax.reload();

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
            $('#maisoneditionTable').on('click','.deletemaisonedition',function(){
                var id_maison_edition = $(this).data('id');

                var deleteConfirm = confirm("voulez vous vraiment supprimer cet Utilisateur ?");
                if (deleteConfirm == true) {
                    // AJAX request
                    $.ajax({
                        url: 'MaisonEditionData.php',
                        type: 'post',
                        data: {request: 4, id_maison_edition: id_maison_edition},
                        success: function(response){

                            if(response == 1){
                                alert("Utilisateur supprimé avec succés.");

                                // Recharger DataTable
                                MaisoneditionDataTable.ajax.reload();
                            }else{
                                alert("Id invalide.");
                            }

                        }
                    });
                }

            });


            // Nouveau maison edition
            $('#btn_insert').click(function(){


                var date_edition = $('DateI').val().trim();
           
                var genre = $('GenreI').val().trim();

                if(date_edition !='' && genre! =''){

                    // AJAX reponse
                    $.ajax({
                        url: 'MaisonEditionData.php',
                        type: 'post',
                        data: {request: 5,date_edition: date_edition, genre: genre},
                        dataType: 'json',
                        success: function(response){
                            if(response.status == 1){
                                alert(response.message);

                                // Vider les Champs
                                $('#Date').val('');
                               $('#Genre').val('');


                                // Recharger DataTable
                                MaisonEditionDataTable.ajax.reload();

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
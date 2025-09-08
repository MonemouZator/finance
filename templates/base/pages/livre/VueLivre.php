
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
            <h1 class="m-0">Consultation :</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Page Consultation</li>
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
                  
                    <div class="card-body">
                          <table id="rendezvousTable" class="table table-dark table-bordered table-striped" width="100%">
                              <thead>
                              <tr>
                              <th>Nom Patient</th>
                              <th>Prénom Patient</th>
                                    <th>DateRdv</th>
                                    <th>HeureRdv</th>
                                    
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
                            <h4 class="modal-title">Formulaire Consultation :</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="idrdv" >Rendez-Vous :</label>
                                <select class="form-control" name="" id="idrdv">
                                    <option value=""> Rendez-Vous </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="NomMedecin" >Nom Medecin :</label>
                                <select class="form-control" name="" id="NomMedecin">
                                    <option value=""> Medecin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="DateConslt" >Date Consultation :</label>
                                <input type="Date" class="form-control" id="DateConslt" placeholder="DateConslt" required>
                            </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="DateRdv" >Date Rendez-Vous:</label>
                                <input type="Date" class="form-control" id="DateRdv" placeholder="" required>

                            </div>

                            <div class="form-group">
                                <label for="HeureRdv" >Heure Rendez-Vous:</label>
                                <input type="time" class="form-control" id="HeureRdv" placeholder="DateConslt" required>

                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <input type="text" id="txt_userid" value="0">
                            <button type="button" class="btn btn-outline-light btn-sm" id="btn_save">Sauvgarder</button>
                            <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
                
            </div>
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
          remplirListemedecin();
          remplirListerendezvous()
          var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
      // DataTable
         var ConsultationDataTable = $('#rendezvousTable').DataTable({
                'processing': true,
                "responsive": true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'ConsultationData.php'
                },
                'columns': [
                    { data: 'NomPatient' },
                    { data: 'PrenomPatient' },
                    { data: 'DateRdv' },
                    { data: 'HeureRdv' },
                    
                    { data: 'action' },
                ]

            });


            // Afficher enregistrement
            $('#rendezvousTable').on('click','.updaterendezvous',function(){
                var Idrdv = $(this).data('id');

                $('#txt_userid').val(Idrdv);

                // AJAX REPONSE
                // $.ajax({
                //     url: 'rendezvousData.php',
                //     type: 'post',
                //     data: {request: 2, idrdv: Idrdv},
                //     dataType: 'json',
                //     success: function(response){
                //       console.log(response)
                //         if(response.patient == 1){

                //             $('#DateRdv').val(response.data.DateRdv);
                //             $('#HeureRdv').val(response.data.HeureRdv);
                       

                //         }
                //         else{
                //             alert("Invalid ID.");
                //         }
                //     }
                // });

            });


            // Sauvegarder les modification RendezVous
            $('#btn_save').click(function(){
                var id = $('#txt_userid').val();

                var DateRdv = $('#DateRdv').val().trim();
                var HeureRdv = $('#HeureRdv').val().trim();
                // var IdPatient = $('#IdPatient').val().trim();

                if(DateRdv !='' && HeureRdv != ''){

                    // AJAX reponse
                    $.ajax({
                        url: 'ConsultationData.php',
                        type: 'post',
                        data: {request: 3, id: id,DateRdv: DateRdv, HeureRdv: HeureRdv},
                        dataType: 'json',
                        success: function(response){
                            if(response.status == 1){
                                alert(response.message);

                                // Vider les Champs
                                $('#DateRdv','#HeureRdv')
                                $('#txt_userid').val(0);

                                // Recharger DataTable
                                ConsultationDataTable.ajax.reload();

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
            $('#rendezvousTable').on('click','.deleterendezvous',function(){
                var idrdv = $(this).data('idrdv');

                var deleteConfirm = confirm("voulez vous vraiment supprimer cet Utilisateur ?");
                if (deleteConfirm == true) {
                    // AJAX request
                    $.ajax({
                        url: 'ConsultationData.php',
                        type: 'post',
                        data: {request: 5, idrdv: idrdv},
                        success: function(response){

                            if(response == 1){
                               // alert("Utilisateur supprimé avec succés.");
                                Toast.fire({
                                icon: 'error',
                 title: 'Utilisateur supprimé avec succés.'
                        });
                                // Recharger DataTable
                                rendezvousDataTable.ajax.reload();
                            }else{
                                alert("Id invalide.");
                            }

                        }
                    });
                }

            });

          });
                    function remplirListemedecin() {
                      $.ajax({
                      url: 'ConsultationData.php',
                      type: 'post',
                      data: {request: 6},
                      dataType: 'json',
                      success: function(response){

                        var len = response.length;

                        for( var i = 0; i<len; i++){
                          var id = response[i]['IdMed'];
                          var name = response[i]['NomMedecin'];
                          var name2 = response[i]['PrenomMedecin'];

                          $("#NomMedecin").append("<option value='"+id+"'>"+name+" "+name2+"</option>");

                        }
                      }
                   });
                       }
                       function remplirListerendezvous() {
                      $.ajax({
                      url: 'ConsultationData.php',
                      type: 'post',
                      data: {request: 7},
                      dataType: 'json',
                      success: function(response){

                        var len = response.length;

                        for( var i = 0; i<len; i++){
                          var id = response[i]['idrdv'];
                          var name = response[i]['PrenomPatient'];
                          var name2 = response[i]['NomPatient'];

                          $("#idrdv").append("<option value='"+id+"'>"+name+" "+name2+"</option>");

                        }
                      }
                   });
                       }
                       $("#idrdv").change(function (e){
                        console.log(e.target.value)
                        var id = e.target.value
                        $.ajax({
                      url: 'ConsultationData.php',
                      type: 'post',
                      data: {request: 8,id:id},
                      dataType: 'json',
                      success: function(response){

                        var len = response.length;

                        for( var i = 0; i<len; i++){
                          var id = response[i]['idrdv'];
                          var DateRdv = response[i]['DateRdv'];
                          var HeureRdv = response[i]['HeureRdv'];

                          $("#DateRdv").val(DateRdv)
                          $("#HeureRdv").val(HeureRdv)


                        }
                      }
                   });
                       })
        </script>

</body>
</html>

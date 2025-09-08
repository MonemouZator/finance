<?php
require_once("../../inc/entete.php");

?>
<div class="wrapper">

<?php
require_once("../../inc/header.php");
require_once("../../inc/menu.php");
?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Starter Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Acceuil</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">La liste:

                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-secondary">
                  Launch Secondary Modal
                </button>
                </h5>
              </div>
              <div class="card-body">
              <table id="UserTable" class="table table-bordered table-striped" width="100%">
                  <thead>
                  <tr>
                  <th>Nom</th>
                    <th>Email</th>
                    <th>Genre</th>
                    <th>ville</th>
                    <th>Action</th>
                  
                  
                  </tr>
                  </thead>
                  
                </table>
              </div>
            </div>
            <div class="modal fade" id="modal-secondary">
        <div class="modal-dialog">
          <div class="modal-content bg-Warning">
            <div class="modal-header">
              <h4 class="modal-title">Formulaire user</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p><div class="col-lg-12">


  <form id="form">
      <div class="form-group">
        <label for="exampleInputEmail1">Nom User</label>
        <input type="text" id="nom" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email User</label>
        <input type="text" id="prenom" class="form-control" id="exampleInputEmail1" placeholder="Enter prenom">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Genre User</label>
        <input type="email" id="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Ville User</label>
        <input type="text" id="username" class="form-control" id="exampleInputPassword1" placeholder="username">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" id="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
    <!-- /.card-body -->

    
  </form>
  
</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline-light">Save changes</button>
            </div>
          </div>
          </div>
          
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  require_once("../../inc/config.php");
  require_once("../../inc/footer.php");

  ?>

</div>
<!-- ./wrapper -->

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
<script>
         $(document).ready(function(){
//DataTable
var UserDataTable =$('#UserTable').DataTable({
  'processing': true,
  'serverSide': true,
  'serverMethod' : 'post',
  'ajax': {
    'url': 'UserData.php'
  },
  'columns' :[   
   
    { data: 'name'},
    { data: 'email'},
    { data: 'gender'},  
    { data: 'city'},  
    { data: 'action'},
  ]
 
});
});

       
</script>

</body>
</html>

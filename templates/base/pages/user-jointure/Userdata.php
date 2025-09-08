<?php
include 'config.inc.php';

$request = 1;
if(isset($_POST['request'])){
    $request = $_POST['request'];
}

// DataTable data
if($request == 1){
    // Lire la valeur
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    // Affichage des lignes par page
    $rowperpage = $_POST['length'];
    // Indice de colonne
    $columnIndex = $_POST['order'][0]['column'];
    //Nom de colonne
    $columnName = $_POST['columns'][$columnIndex]['data'];
    // asc ou desc
    $columnSortOrder = $_POST['order'][0]['dir'];
    // Valeur de recherche
    $searchValue = mysqli_escape_string($con,$_POST['search']['value']);

    ## recherche
    $searchQuery = " ";
    if($searchValue != ''){
        $searchQuery = " and (name like '%".$searchValue."%' or
            email like '%".$searchValue."%' or
            city like'%".$searchValue."%' or gender like'%".$searchValue."%' or libelle like'%".$searchValue."%' ) ";
    }

    ##Nombre total d'enregistrements sans filtrage
    $sel = mysqli_query($con,"select count(*) as allcount FROM `users` U INNER JOIN statut S
    ON U.Idstatut=S.Idstatut");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

    ## Nombre total d'enregistrements avec filtrage
    $sel = mysqli_query($con,"select count(*) as allcount FROM `users` U INNER JOIN statut S
    ON U.Idstatut=S.Idstatut WHERE 1 ".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Récupérer des enregistrements
    $empQuery = "SELECT U.id,U.name,U.gender,U.city,U.email,S.libelle FROM `users` U INNER JOIN statut S
    ON U.Idstatut=S.Idstatut WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();

    while ($row = mysqli_fetch_assoc($empRecords)) {

        // Update Button
        $updateButton = "<button class='btn btn-sm btn-primary updateUser' data-id='".$row['id']."' data-toggle='modal' data-target='#updateModal' >Update</button>";

        // Delete Button
        $deleteButton = "<button class='btn btn-sm btn-danger deleteUser' data-id='".$row['id']."'>Delete</button>";

        $action = $updateButton." ".$deleteButton;

        $data[] = array(

                "name" => $row['name'],
                "email" => $row['email'],
                "gender" => $row['gender'],
                "city" => $row['city'],
                "libelle" => $row['libelle'],
                "action" => $action
            );
    }

    ## Response
    $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
    );

    echo json_encode($response);
    exit;
}

// Fetch user details
if($request == 2){
    $id = 0;

    if(isset($_POST['id'])){
        $id = mysqli_escape_string($con,$_POST['id']);
    }

    $record = mysqli_query($con,"SELECT * FROM users WHERE id=".$id);

    $response = array();

    if(mysqli_num_rows($record) > 0){
        $row = mysqli_fetch_assoc($record);
        $response = array(
            "name" => $row['name'],
            "email" => $row['email'],
            "gender" => $row['gender'],
            "city" => $row['city'],
        );

        echo json_encode( array("status" => 1,"data" => $response) );
        exit;
    }else{
        echo json_encode( array("status" => 0) );
        exit;
    }
}

// mise à jour user
if($request == 3){
    $id = 0;

    if(isset($_POST['id'])){
        $id = mysqli_escape_string($con,$_POST['id']);
    }

    // Vérifier l'identité
    $record = mysqli_query($con,"SELECT id FROM users WHERE id=".$id);
    if(mysqli_num_rows($record) > 0){

        $name = mysqli_escape_string($con,trim($_POST['name']));
        $email = mysqli_escape_string($con,trim($_POST['email']));
        $gender = mysqli_escape_string($con,trim($_POST['gender']));
        $city = mysqli_escape_string($con,trim($_POST['city']));

        if( $name != '' && $email != '' && $gender != '' && $city != '' ){

            mysqli_query($con,"UPDATE users SET name='".$name."',email='".$email."',gender='".$gender."',city='".$city."' WHERE id=".$id);

            echo json_encode( array("status" => 1,"message" => "Enregistrement mis à jour.") );
            exit;
        }else{
            echo json_encode( array("status" => 0,"message" => "Merci de compléter tous les champs.") );
            exit;
        }

    }else{
        echo json_encode( array("status" => 0,"message" => "ID invalide.") );
        exit;
    }
}

/// nouveau user
// mise à jour user
if($request == 5){

      $name = mysqli_escape_string($con,trim($_POST['name']));
      $email = mysqli_escape_string($con,trim($_POST['email']));
      $gender = mysqli_escape_string($con,trim($_POST['gender']));
      $city = mysqli_escape_string($con,trim($_POST['city']));
      $Idstatut  = mysqli_escape_string($con,trim($_POST['Idstatut']));
      if( $name != '' && $email != '' && $gender != '' && $city != '' ){

          mysqli_query($con,"INSERT INTO  users(`name`, `gender`, `city`, `email`, `Idstatut`)
          VALUES ('".$name."','".$gender."','".$city."','".$email."',".$Idstatut.")");

          echo json_encode( array("status" => 1,"message" => "Enregistrement ajouter avec Succée.") );
          exit;
      }
      else{
          echo json_encode( array("status" => 0,"message" => "Merci de compléter tous les champs.") );
          exit;
      }


}

// Supprimer User
if($request == 4){
    $id = 0;

    if(isset($_POST['id'])){
        $id = mysqli_escape_string($con,$_POST['id']);
    }

    // verifier id
    $record = mysqli_query($con,"SELECT id FROM users WHERE id=".$id);
    if(mysqli_num_rows($record) > 0){

        mysqli_query($con,"DELETE FROM users WHERE id=".$id);

        echo 1;
        exit;
    }else{
        echo 0;
        exit;
    }
}
// Remplir Liste

if($request == 6){


  $record = mysqli_query($con,"SELECT * FROM statut");



   $response = array();
   while($row = mysqli_fetch_array($record)){


      $response[] = array(
        "Idstatut" => $row['Idstatut'],
        "libelle" => $row['libelle'],
    );

   }

   echo json_encode($response);
   exit;
}

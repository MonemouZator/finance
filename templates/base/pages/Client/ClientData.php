<?php
include '../../inc/config.inc.php';

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
        $searchQuery = " and (nom like '%".$searchValue."%' or
            prenom like '%".$searchValue."%' or
            adresse like'%".$searchValue."%' or telephone like'%".$searchValue."%' or DateNai like '%".$searchValue."%' or email like '%".$searchValue."%') ";
    }

    ##Nombre total d'enregistrements sans filtrage
    $sel = mysqli_query($con,"select count(*) as allcount from client");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

    ## Nombre total d'enregistrements avec filtrage
    $sel = mysqli_query($con,"select count(*) as allcount from client WHERE 1 ".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Récupérer des enregistrements
    $empQuery = "select * from client WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();

    while ($row = mysqli_fetch_assoc($empRecords)) {

        // Update Button
        $updateButton = "<button class='btn btn-sm btn-primary updateclient' data-id='".$row['id']."' data-toggle='modal' data-target='#updateModal' >Update</button>";

        // Delete Button
        $deleteButton = "<button class='btn btn-sm btn-danger deleteclient' data-id='".$row['id']."'>Delete</button>";

        $action = $updateButton." ".$deleteButton;

        $data[] = array(
                "nom" => $row['nom'],
                "prenom" => $row['prenom'],
                "adresse" => $row['adresse'],
                "telephone" => $row['telephone'],
                "DateNai" => $row['DateNai'],
                "email" => $row['email'],
                
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

// Fetch client details
if($request == 2){
    $id= 0;

    if(isset($_POST['id'])){
        $id = mysqli_escape_string($con,$_POST['id']);
    }

    $record = mysqli_query($con,"SELECT * FROM client WHERE id=".$id);

    $response = array();

    if(mysqli_num_rows($record) > 0){
        $row = mysqli_fetch_assoc($record);
        $response = array(
            "nom" => $row['nom'],
            "prenom" => $row['prenom'],
            "adresse" => $row['adresse'],
            "telephone" => $row['telephone'],
            "DateNai" => $row['DateNai'],
            "email" => $row['email'],
          
        );

        echo json_encode( array("status" => 1,"data" => $response) );
        exit;
    }else{
        echo json_encode( array("status" => 0) );
        exit;
    }
}

// mise à jour client
if($request == 3){
    $Id = 0;

    if(isset($_POST['id'])){
        $Id = mysqli_escape_string($con,$_POST['id']);
    }

    // Vérifier l'identité
    $record = mysqli_query($con,"SELECT id FROM client WHERE id=".$id);
    if(mysqli_num_rows($record) > 0){

        $nom = mysqli_escape_string($con,trim($_POST['nom']));
        $prenom = mysqli_escape_string($con,trim($_POST['prenom']));
        $adresse = mysqli_escape_string($con,trim($_POST['adresse']));
        $telephone = mysqli_escape_string($con,trim($_POST['telephone']));
        $DateNai = mysqli_escape_string($con,trim($_POST['DateNai']));
        $email = mysqli_escape_string($con,trim($_POST['email']));
      

        if( $nom != '' && $prenom != '' && $adresse != '' && $telephone != ''  && $DateNai != ''  && $email != '' ){

            mysqli_query($con,"UPDATE client SET nom='".$nom."',prenom='".$prenom."',adresse='".$adresse."',telephone='".$telephone."',DateNai='".$DateNai."', email='".$email."' WHERE id=".$id);

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

/// nouveau client
// mise à jour client
if($request == 5){


  // Vérifier l'identité


      $nom = mysqli_escape_string($con,trim($_POST['nom']));
      $prenom = mysqli_escape_string($con,trim($_POST['prenom']));
      $adresse = mysqli_escape_string($con,trim($_POST['adresse']));
      $telephone = mysqli_escape_string($con,trim($_POST['telephone']));
      $DateNai = mysqli_escape_string($con,trim($_POST['DateNai']));
      $email = mysqli_escape_string($con,trim($_POST['email']));
   

      if( $nom != '' && $prenom != '' && $adresse != '' && $telephone != ''  && $DateNai != ''   && $email != '' ){

        mysqli_query($con,"INSERT INTO  client(`nom`, `prenom`, `adresse`, `telephone` , `DateNai` , `email`)
           VALUES ('".$nom."','".$prenom."','".$adresse."','".$telephone."','".$DateNai."','".$email."')");

          echo json_encode( array("status" => 1,"message" => "Enregistrement ajouter avec Succée.") );
          exit;
      }
      else{
          echo json_encode( array("status" => 0,"message" => "Merci de compléter tous les champs.") );
          exit;
      }


}

// Supprimer client
if($request == 4){
    $id = 0;

    if(isset($_POST['id'])){
        $id = mysqli_escape_string($con,$_POST['id']);
    }

    // verifier id
    $record = mysqli_query($con,"SELECT id FROM client WHERE id=".$id);
    if(mysqli_num_rows($record) > 0){

        mysqli_query($con,"DELETE FROM client WHERE id=".$id);

        echo 1;
        exit;
    }else{
        echo 0;
        exit;
    }
}
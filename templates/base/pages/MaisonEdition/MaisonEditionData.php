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
        $searchQuery = " and (date_edition like '%".$searchValue."%' or genre like '%".$searchValue."%') ";
    }

    ##Nombre total d'enregistrements sans filtrage
    $sel = mysqli_query($con,"select count(*) as allcount from maisonedition");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

    ## Nombre total d'enregistrements avec filtrage
    $sel = mysqli_query($con,"select count(*) as allcount from maisonedition WHERE 1 ".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Récupérer des enregistrements
    $empQuery = "select * from maisonedition WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();

    while ($row = mysqli_fetch_assoc($empRecords)) {

        // Update Button
        $updateButton = "<button class='btn btn-sm btn-primary updatemaisonedition' data-id='".$row['id_maison_edition']."' data-toggle='modal' data-target='#updateModal' >Update</button>";
        // Delete Button
        $deleteButton = "<button class='btn btn-sm btn-danger deletemaisonedition' data-id='".$row['id_maison_edition']."'>Delete</button>";


        $action = $updateButton." ".$deleteButton;

        $data[] = array(
                "date_edition" => $row['date_edition'],
                "genre" => $row['genre'],
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

// Fetch MaisonEdition details
if($request == 2){
    $id_maison_edition= 0;

    if(isset($_POST['id_maison_edition'])){
        $id_maison_edition = mysqli_escape_string($con,$_POST['id_maison_edition']);
    }

    $record = mysqli_query($con,"SELECT * FROM maisonedition WHERE id_maison_edition=".$id_maison_edition);

    $response = array();

    if(mysqli_num_rows($record) > 0){
        $row = mysqli_fetch_assoc($record);
        $response = array(
            "date_edition" => $row['date_edition'],
          "genre" => $row ['genre'],
            
        );

        echo json_encode( array("status" => 1,"data" => $response) );
        exit;
    }else{
        echo json_encode( array("status" => 0) );
        exit;
    }
}

// mise à jour Maison Edition
if($request == 3){
    $id_maison_edition = 0;

    if(isset($_POST['id_maison_edition'])){
        $id_maison_edition = mysqli_escape_string($con,$_POST['id_maison_edition']);
    }

    // Vérifier l'identité
    $record = mysqli_query($con,"SELECT id_maison_edition FROM maiasonedition WHERE id_maison_edition=".$id_maison_edition);
    if(mysqli_num_rows($record) > 0){

        $date_edition = mysqli_escape_string($con,trim($_POST['date_edition']));
      $genre = mysqli_escape_string($con,trim($_POST['genre']));

        if( $NomMaladie != '' && $genre !=''){

            mysqli_query($con,"UPDATE maisonedition SET date_edition ='".$date_edition."', genre ='".$genre."' WHERE id_maison_edition=".$id_maison_edition);

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

/// nouveau maison edition
// mise à jour maison edition
if($request == 5){


  // Vérifier l'identité


      $date_edition = mysqli_escape_string($con,trim($_POST['date_edition']));
     $genre = mysqli_escape_string($con,trim($_POST['genre']));
      

      if( $date_edition != ''&& $genre != ''){

          mysqli_query($con,"INSERT INTO  maisoonedition(`date_edition`,`genre`)
          VALUES ('".$date_edition."','".$genre."')");

          echo json_encode( array("status" => 1,"message" => "Enregistrement ajouter avec Succée.") );
          exit;
      }
      else{
          echo json_encode( array("status" => 0,"message" => "Merci de compléter tous les champs.") );
          exit;
      }


}

// Supprimer maison edition
if($request == 4){
    $id_maison_edition = 0;

    if(isset($_POST['id_maison_edition'])){
        $id_maison_edition = mysqli_escape_string($con,$_POST['id_maison_edition']);
    }

    // verifier id_maison_edition
    $record = mysqli_query($con,"SELECT id_maison_edition FROM maisonedition WHERE id_maison_edition=".$id_maison_edition);
    if(mysqli_num_rows($record) > 0){

        mysqli_query($con,"DELETE FROM maisonedition WHERE id_maison_edition=".$id_maison_edition);

        echo 1;
        exit;
    }else{
        echo 0;
        exit;
    }
}
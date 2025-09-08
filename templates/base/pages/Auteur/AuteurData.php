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
            telephone like'%".$searchValue."%' or email like'%".$searchValue."%' or adresse like '%".$searchValue."%' or datenaissance like '%".$searchValue."%') ";
    }

    ##Nombre total d'enregistrements sans filtrage
    $sel = mysqli_query($con,"select count(*) as allcount from auteur");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];
    
    ## Nombre total d'enregistrements avec filtrage
    $sel = mysqli_query($con,"select count(*) as allcount from auteur WHERE 1 ".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Récupérer des enregistrements
    $empQuery = "select * from auteur WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();

    while ($row = mysqli_fetch_assoc($empRecords)) {

        // Update Button
        $updateButton = "<button class='btn btn-sm btn-primary updateauteur' data-id='".$row['IdAuteur']."' data-toggle='modal' data-target='#updateModal' >Update</button>";

        // Delete Button
        $deleteButton = "<button class='btn btn-sm btn-danger deleteauteur' data-id='".$row['IdAuteur']."'>Delete</button>";

        $action = $updateButton." ".$deleteButton;

        $data[] = array(
                "nom" => $row['nom'],
                "prenom" => $row['prenom'],
                "telephone" => $row['telephone'],
                "email" => $row['email'],
                "adresse" => $row['adresse'],
                "datenaissance" => $row['datenaissance'],
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

// Fetch auteur details
if($request == 2){
    $IdAuteur= 0;

    if(isset($_POST['IdAuteur'])){
        $IdAuteur = mysqli_escape_string($con,$_POST['IdAuteur']);
    }

    $record = mysqli_query($con,"SELECT * FROM auteur WHERE IdAuteur=".$IdAuteur);

    $response = array();

    if(mysqli_num_rows($record) > 0){
        $row = mysqli_fetch_assoc($record);
        $response = array(
            "nom" => $row['nom'],
            "prenom" => $row['prenom'],
            "telephone" => $row['telephone'],
            "email" => $row['email'],
            "adresse" => $row['adresse'],
            "datenaissance" => $row['datenaissance'],
            
        );

        echo json_encode( array("status" => 1,"data" => $response) );
        exit;
    }else{
        echo json_encode( array("status" => 0) );
        exit;
    }
}

// mise à jour auteur
if($request == 3){
    $IdAuteur = 0;

    if(isset($_POST['IdAuteur'])){
        $IdAuteur = mysqli_escape_string($con,$_POST['IdAuteur']);
    }

    // Vérifier l'identité
    $record = mysqli_query($con,"SELECT IdAuteur FROM auteur WHERE IdAuteur=".$IdAuteur);
    if(mysqli_num_rows($record) > 0){

        $nom = mysqli_escape_string($con,trim($_POST['nom']));
        $prenom = mysqli_escape_string($con,trim($_POST['prenom']));
        $telephone = mysqli_escape_string($con,trim($_POST['telephone']));
        $email = mysqli_escape_string($con,trim($_POST['email']));
        $adresse = mysqli_escape_string($con,trim($_POST['adresse']));
        $datenaissance = mysqli_escape_string($con,trim($_POST['datenaissance']));
      

        if( $nom != '' && $prenom != '' && $telephone != '' && $email != ''  && $adresse != ''  && $datenaissance != '' ){

            mysqli_query($con,"UPDATE auteur SET nom='".$nom."',prenom='".$prenom."',telephone='".$telephone."',email='".$email."',adresse='".$adresse."', datenaissance='".$datenaissance."' WHERE IdAuteur=".$IdAuteur);

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

/// nouveau auteur
// mise à jour auteur
if($request == 5){


  // Vérifier l'identité


      $nom = mysqli_escape_string($con,trim($_POST['nom']));
      $prenom = mysqli_escape_string($con,trim($_POST['prenom']));
      $telephone = mysqli_escape_string($con,trim($_POST['telephone']));
      $email = mysqli_escape_string($con,trim($_POST['email']));
      $adresse = mysqli_escape_string($con,trim($_POST['adresse']));
      $datenaissance = mysqli_escape_string($con,trim($_POST['datenaissance']));
      

      if( $nom != '' && $prenom != '' && $telephone != '' && $email != ''  && $adresse != ''   && $datenaissance != ''){

          mysqli_query($con,"INSERT INTO  auteur(`nom`, `prenom`, `telephone`, `email` , `adresse` , `datenaissance`)
          VALUES ('".$nom."','".$prenom."','".$telephone."','".$email."','".$adresse."','".$datenaissance."')");

          echo json_encode( array("status" => 1,"message" => "Enregistrement ajouter avec Succée.") );
          exit;
      }
      else{
          echo json_encode( array("status" => 0,"message" => "Merci de compléter tous les champs.") );
          exit;
      }


}

// Supprimer auteur
if($request == 4){
    $IdAuteur = 0;

    if(isset($_POST['IdAuteur'])){
        $IdAuteur = mysqli_escape_string($con,$_POST['IdAuteur']);
    }

    // verifier IdAuteur
    $record = mysqli_query($con,"SELECT IdAuteur FROM auteur WHERE IdAuteur=".$IdAuteur);
    if(mysqli_num_rows($record) > 0){

        mysqli_query($con,"DELETE FROM auteur WHERE IdAuteur=".$IdAuteur);

        echo 1;
        exit;
    }else{
        echo 0;
        exit;
    }
}
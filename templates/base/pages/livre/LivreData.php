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
        $searchQuery = " and (DateRdv like '%".$searchValue."%' or
        HeureRdv like '%".$searchValue."%') ";
    }

    ##Nombre total d'enregistrements sans filtrage
    $sel = mysqli_query($con,"select count(*) as allcount FROM `rendezvous` R INNER JOIN patient P
    ON R.idrdv=P.IdPatient");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

    ## Nombre total d'enregistrements avec filtrage
    $sel = mysqli_query($con,"select count(*) as allcount FROM `rendezvous` R INNER JOIN patient P
    ON R.idrdv=P.IdPatient WHERE 1 ".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Récupérer des enregistrements
    $empQuery = "SELECT R.idrdv,R.DateRdv,R.HeureRdv,P.IdPatient,P.NomPatient,P.PrenomPatient  FROM `rendezvous` R INNER JOIN patient P
    ON P.IdPatient=R.IdPatient WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();

    while ($row = mysqli_fetch_assoc($empRecords)) {

        // Update Button
        $updateButton = "<button class='btn btn-sm btn-primary updaterendezvous' data-id='".$row['IdPatient']."' data-toggle='modal' data-target='#updateModal' >Consultation</button>";

        // Delete Button
       

        $action = $updateButton;

        $data[] = array(
                "NomPatient" => $row['NomPatient'],
                "PrenomPatient" => $row['PrenomPatient'],
                "DateRdv" => $row['DateRdv'],
                "HeureRdv" => $row['HeureRdv'],
              
                
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

// Fetch RendezVous details
if($request == 2){
    $idrdv = 0;

    if(isset($_POST['idrdv'])){
        $idrdv = mysqli_escape_string($con,$_POST['idrdv']);
        // echo $idrdv;
    }

    $record = mysqli_query($con,"SELECT * FROM `rendezvous` WHERE `IdPatient` =  '$idrdv'");

    $response = array();

    if(mysqli_num_rows($record) > 0){
        $row = mysqli_fetch_assoc($record);
        $response = array(
            "DateRdv" => $row['DateRdv'],
            "HeureRdv" => $row['HeureRdv'],
          
           
        );

        echo json_encode( array("patient" => 1,"data" => $response) );
        exit;
    }else{
        echo json_encode( array("patient" => 0) );
        exit;
    }
}

// mise à jour RendezVous
if($request == 3){
    $idrdv = 0;

    if(isset($_POST['id'])){
        $idrdv = mysqli_escape_string($con,$_POST['id']);
    }

    // Vérifier l'identité
    $record = mysqli_query($con,"SELECT * FROM `rendezvous` WHERE `IdPatient` =  '$idrdv'");
    if(mysqli_num_rows($record) > 0){

        $DateRdv = mysqli_escape_string($con,trim($_POST['DateRdv']));
        $HeureRdv = mysqli_escape_string($con,trim($_POST['HeureRdv']));
       
     

        if( $DateRdv != '' && $HeureRdv != '' ){

            mysqli_query($con,"UPDATE rendezvous SET DateRdv='".$DateRdv."', HeureRdv='".$HeureRdv."' WHERE IdPatient =".$idrdv);

            echo json_encode( array("patient" => 1,"message" => "Enregistrement mis à jour.") );
            exit;
        }else{
            echo json_encode( array("patient" => 0,"message" => "Merci de compléter tous les champs.") );
            exit;
        }

    }else{
        echo json_encode( array("patient" => 0,"message" => "ID invalide.") );
        exit;
    }
}

/// nouveau RendezVous
// mise à jour RendezVous
if($request == 4){

      $DateRdv = mysqli_escape_string($con,trim($_POST['DateRdv']));
      $HeureRdv = mysqli_escape_string($con,trim($_POST['HeureRdv']));
      $IdPatient = mysqli_escape_string($con,trim($_POST['IdPatient']));
  
   
      if( $DateRdv != '' && $HeureRdv != ''){

          mysqli_query($con,"INSERT INTO `rendezvous`(`DateRdv`, `HeureRdv`, `IdPatient`) 
          VALUES ('$DateRdv','$HeureRdv','$IdPatient')");

          echo json_encode( array("patient" => 1,"message" => "Enregistrement ajouter avec Succée.") );
          exit;
      }
      else{
          echo json_encode( array("patient" => 0,"message" => "Merci de compléter tous les champs.") );
          exit;
      }


}

// Supprimer rendezvous
if($request == 5){
    $idrdv = 0;

    if(isset($_POST['idrdv'])){
        $idrdv = mysqli_escape_string($con,$_POST['idrdv']);
    }

    // verifier IdRdv
    $record = mysqli_query($con,"SELECT idrdv FROM rendezvous WHERE idrdv=".$idrdv);
    if(mysqli_num_rows($record) > 0){

        mysqli_query($con,"DELETE FROM rendezvous WHERE idrdv=".$idrdv);

        echo 1;
        exit;
    }else{
        echo 0;
        exit;
    }
}
// Remplir Liste

if($request == 6){


  $record = mysqli_query($con,"SELECT * FROM `medecin`");



   $response = array();
   while($row = mysqli_fetch_array($record)){


      $response[] = array(
        "IdMed" => $row['IdMed'],
        "NomMedecin" => $row['NomMedecin'],
        "PrenomMedecin" => $row['PrenomMedecin'],
    );

   }

   echo json_encode($response);
   exit;
}
// Remplir Liste

if($request == 7){


    $record = mysqli_query($con,"SELECT * FROM `rendezvous` r INNER JOIN patient p ON r.IdPatient = p.IdPatient");
  
  
  
     $response = array();
     while($row = mysqli_fetch_array($record)){
  
  
        $response[] = array(
          "idrdv" => $row['idrdv'],
          "PrenomPatient" => $row['PrenomPatient'],
          "NomPatient" => $row['NomPatient']

      );
  
     }
  
     echo json_encode($response);
     exit;
  }
  if($request == 8){
    $id = $_POST['id'];

    $record = mysqli_query($con,"SELECT * FROM `rendezvous` r INNER JOIN patient p ON r.IdPatient = p.IdPatient WHERE r.idrdv = '$id'");
  
  
  
     $response = array();
     while($row = mysqli_fetch_array($record)){
  
  
        $response[] = array(
          "idrdv" => $row['idrdv'],
          "DateRdv" => $row['DateRdv'],
          "HeureRdv" => $row['HeureRdv']

      );
  
     }
  
     echo json_encode($response);
     exit;
  }
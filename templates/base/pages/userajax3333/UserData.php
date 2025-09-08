<?php

include '../../inc/connexion.inc.php';

$request = 1;
if(isset($_POST['request'])){
    $request = $_POST['request'];
}

// DataTable data
if($request == 1){
    ##Lire la valeur
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
            city like'%".$searchValue."%' ) ";
    }

    ##Nombre total d'enregistrements sans filtrage
    $sel = mysqli_query($con,"select count(*) as allcount from users");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

    ## Nombre total d'enregistrements avec filtrage
    $sel = mysqli_query($con,"select count(*) as allcount from users WHERE 1 ".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Récupérer des enregistrements
    $empQuery = "select * from users WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();

    while ($row = mysqli_fetch_assoc($empRecords)) {

        // Update Button
        $updateButton = "<button class='btn btn-sm btn-info updateUser' data-id='".$row['id']."' data-toggle='modal' data-target='#updateModal' >Update</button>";

        // Delete Button
        $deleteButton = "<button class='btn btn-sm btn-danger deleteUser' data-id='".$row['id']."'>Delete</button>";

        $action = $updateButton." ".$deleteButton;

        $data[] = array(
                "name" => $row['name'],
                "email" => $row['email'],
                "gender" => $row['gender'],
                "city" => $row['city'],
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

?>




<html lang="fr">
<?php
/*
function recuperationDonnesNormale()
{
try
{
$cnx = new PDO('mysql:dbname='.BDD.';host='.HOST.';port='.PORT,LOGIN,PASSW);

$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $cnx->prepare("SELECT nom_resource,lib_resource,nb_place FROM Resource");

$stmt->execute();


$tmp = '<div><table><tr><th>Ressources disponibles</th><th>Nombre de place</th><th>PU.HT</th><th>PU.TTC</th></tr>';

if ($result = $reqt->fetchAll())
    {
        foreach($result as $ligne)
            $tmp .= "<tr><td>".$ligne['nom_resource'].'</td><td>'.$ligne['lib_resource'].'</td><td>'.$ligne['nb_place'].'</td></tr>';
    }
$tmp .= '</div></table>';
return $tmp;
}
catch(PDOException $e)
{
    echo "Database error: ".$e->getMessage();
}} */




function getBureau($srch)
{
    // Initalisation de la variable de retour
    $rep = array();
    if ($srch == '')
    {   $srch = date('Y-m-d');}
    // Gestion des erreurs
    try 
    {
        
        // Création de l'objet PDO
        $cnx = new PDO(SGBDR.':dbname='.BDD.';host='.HOST.';port='.PORT, LOGIN, PASSW);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Requete
        $sql = ("SELECT nom_resource,lib_type,nb_place , RES.id_resource
        FROM Resource RES
        INNER JOIN type_resource TYP ON RES.id_typeRes = TYP.id_typeRes
        WHERE RES.id_resource NOT IN (
            SELECT RES.id_resource
            FROM Resource
            INNER JOIN Reservation RESERV ON RES.id_resource = RESERV.id_resource
            WHERE RESERV.dateRes = :srch_date
        )");
                /*WHERE UPPER(nom_resource) LIKE CONCAT(UPPER(:srch_nom),'%')
                OR UPPER(lib_resource) LIKE CONCAT('%',UPPER(:srch_lib),'%');*/
        // Preparation Requete
        $stmt = $cnx->prepare($sql);
        // Association des variables
/*        $stmt->bindParam(':srch_nom', $srch, PDO::PARAM_STR, 50);
        $stmt->bindParam(':srch_lib', $srch, PDO::PARAM_STR, 30);*/
        $stmt->bindParam(':srch_date', $srch, PDO::PARAM_STR, 10);
        // Execution Requete
        $stmt->execute();
        // Fetch Requete
        if($result = $stmt->fetchAll())
        {
            $rep['ok'] =  true;
            $rep['data'] = $result;
        }
        else // Si la requête est bonne mais qu'aucune donnée ne correspond aux critères de recherche.
        {
            $rep['ok'] =  false;
            $rep['error'] = '<div class="center"><p><span class="alert">Aucune donnée</span></p></div>';
        }
    }
    

    catch(PDOException $e) // En cas de probleme technique entre php et la bdd
    {
        $rep['ok'] =  false;
        $rep['error'] = '<div class="center"><p><span class="alert">Database error :</span><br>'.$e->getMessage().'</p></div>';
    }
    
    return $rep;
}


function reservationBureau($reservation)
{
    // Initalisation de la variable de retour
    $rep = array();
    
    // Gestion des erreurs
    try 
    {
        // Création de l'objet PDO
        $cnx = new PDO(SGBDR.':dbname='.BDD.';host='.HOST.';port='.PORT, LOGIN, PASSW);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Requete
        $sql = ("INSERT INTO Reservation (dateRes,id_resource,id_user) 
        VALUES (dateRes,id_resource,id_user);
        )");
        // Preparation Requete
        $stmt = $cnx->prepare($sql);
        // Association des variables
        $stmt->bindParam(':selected_date', $srch, PDO::PARAM_STR, 15);
        $stmt->bindParam(':id_resource', $srch, PDO::PARAM_STR, 10);
        $stmt->bindParam(':id_user', $srch, PDO::PARAM_STR, 10);
        // Execution Requete
        $stmt->execute();
    }
    

    catch(PDOException $e) // En cas de probleme technique entre php et la bdd
    {
        $rep['ok'] =  false;
        $rep['error'] = '<div class="center"><p><span class="alert">Database error :</span><br>'.$e->getMessage().'</p></div>';
    }
    
    return $rep;
}


?>
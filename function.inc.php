<?php

/**
 * Procédure qui génère et affichage un champ
 * @param array $argv (libelle, type, name, value, size, disabled, nodiv)
 */
function displayInput($argv)
{
    $tmp = '';
    if(isset($argv['nodiv']) && $argv['nodiv'] !== true)
        $tmp .= '<div>';
    if(isset($argv['libelle']) === true)
        $tmp .= '<label>'.$argv['libelle'].'</label>';
    $tmp .= '<input';
    // [optionnel]Type
    if(isset($argv['type']) === true)
        $tmp .= ' type="'.$argv['type'].'"';
    else
        $tmp .= ' type="text"';
    // [optionnel]Name
    if(isset($argv['name']) === true)
        $tmp .= ' name="'.$argv['name'].'"';
    // [optionnel]Value
    if(isset($argv['value']) === true)
        $tmp .= ' value="'.$argv['value'].'"';
    else
        $tmp .= ' value=""';
    // [optionnel]Size
    if(isset($argv['size']) === true)
        $tmp .= ' size="'.$argv['size'].'"';
    // [optionnel]Readonly
    if(isset($argv['disabled']) && $argv['disabled'] === true)
        $tmp .= ' disabled';
    $tmp .= ' />';
    if(isset($argv['nodiv']) && $argv['nodiv'] !== true)
        $tmp .= '</div>';
    // Affichage
    echo $tmp;
}

/**
 * Procédure qui génère et affichage une liste déroulante
 * @param array $argv (libelle, name, list, value, disabled)
 */
function displaySelect($argv)
{
    $tmp = '<div>';
    if(isset($argv['libelle']) === true)
        $tmp .= '<label>'.$argv['libelle'].'</label>';
    $tmp .= '<select';
    // [optionnel]Name
    if(isset($argv['name']) === true)
        $tmp .= ' name="'.$argv['name'].'"';
    // [optionnel]Readonly
    if(isset($argv['disabled']) && $argv['disabled'] === true)
        $tmp .= ' disabled';
    $tmp .= ' />';
    // List
    foreach($argv['list'] as $key => $value)
    {
        $tmp .= '<option value="'.$key.'"';
        if(isset($argv['value']) === true && $argv['value'] == $key)
            $tmp .= 'selected="selected"';
        $tmp .= '>'.$value.'</option>';
    }
    $tmp .= '</select></div>';
    // Affichage
    echo $tmp;
}

/**
 * Procédure qui génère et affichage un bouton
 * @param array $argv (type, name, value, href, disabled, center, nodiv)
 */
function displayButton($argv)
{
    $tmp = '';
    if(isset($argv['nodiv']) && $argv['nodiv'] !== true)
    {
        // [optionnel]Type
        if(isset($argv['center']) === true)
            $tmp .= '<div class="center">';
        else
            $tmp .= '<div>';
    }
    $tmp .= '<input';
    // [optionnel]Type
    if(isset($argv['type']) === true)
        $tmp .= ' type="'.$argv['type'].'"';
    else
        $tmp .= ' type="button"';
    // [optionnel]Name
    if(isset($argv['name']) === true)
        $tmp .= ' name="'.$argv['name'].'"';
    // [optionnel]Value
    if(isset($argv['value']) === true)
        $tmp .= ' value="'.$argv['value'].'"';
    else
        $tmp .= ' value="Valider"';
    // [optionnel]Href
    if(isset($argv['href']) === true)
        $tmp .= ' onclick="window.location.href=\''.$argv['href'].'\'"';
    // [optionnel]Disabled
    if(isset($argv['disabled']) && $argv['disabled'] === true)
        $tmp .= ' disabled';
    $tmp .= ' />';
    if(isset($argv['nodiv']) && $argv['nodiv'] !== true)
        $tmp .= '</div>';
    // Affichage
    echo $tmp;
}

/**
 * Procédure qui test et récupere une donnée de formulaire Post
 * @param string $var
 * @param string $default [Optionnel]
 */
function recupPost($var, $default='')
{
    return (isset($_POST[$var])?$_POST[$var]:$default);
}

/**
 * Fonction qui récupere et créée le tableau HTML de la liste des bureaux
 * @param array $srch
 */
function getListeBureau($srch)
{
    // Initialisation de la variables temporaire de retour
    $tmp = '';

    // récupération des données dans la BDD via le modèle
    $rep = getBureau($srch);
    $i = 1;
    if($rep['ok']) // Si la récuparation des donnée c'est bien passé
    {
        // Création du tableau HTML d'affichage
        $tmp = '<form method="POST"><div><table><thead><table><tr><th>Ressources disponibles</th><th>Nom des bureaux</th><th>Nombre de place</th><th>'.$srch.'</th></tr></thead><tbody>';
        // Boucle des Bureaux
        foreach($rep['data'] as $ligne)
        {
            $tmp .= '<tr><td>'.$ligne['lib_type'].'</td><td>'.$ligne['nom_resource'].'</td><td>'.$ligne['nb_place'].'</td><td><input type="submit" name="Reserver" value="Réserver">
            <input type="hidden" name="selected_date" value="'.$srch.'">
            <input type="hidden" name="id_user" value="0">
            <input type="hidden" name="id_resource" value="'.$ligne['id_resource'].'"></td></tr>';
            $i++;
        }
        $tmp .= '</tbody></form></table>';
    }
    else // Si on a eu une erreur lors de la récupération des données
        $tmp = $rep['error'];      
    
    return $tmp;
}


?>

<?php

/**
 * 1. Importez la table user dans une base de données que vous aurez créée au préalable via PhpMyAdmin
 * 2. En utilisant l'objet de connexion qui a déjà été défini =>
 *    --> Remplacez les informations de connexion ( nom de la base et vérifiez les paramètres d'accès ).
 *    --> Supprimez le dernier utilisateur de la liste, faites une capture d'écran dans PhpMyAdmin pour me montrer que vous avez supprimé l'entrée et pushez la avec votre code.
 *    --> Faites un truncate de la base de données, les auto incréments présents seront remis à 0
 *    --> Insérez un nouvel utilisateur dans la table ( faites un screenshot et ajoutez le au repo )
 *    --> Finalement, vous décidez de supprimer complètement la table
 *    --> Et pour finir, comme vous n'avez plus de table dans la base de données, vous décidez de supprimer aussi la base de données.
 */

require __DIR__ . '/Classes/DB.php';

$db = new DB();
$db= $db->getInstance();

$sql = "DELETE FROM user WHERE id = 4";
$db->exec($sql);

$sql = "TRUNCATE TABLE user";
$db->exec($sql);

$name = 'nom';
$firstName = 'prenom';
$address = 'rue';
$number = 10;
$zip_code = 10101;
$city = 'ville';
$country = 'pays';
$email = 'email';

$stmt = $db->prepare("
        INSERT INTO user (nom, prenom, rue, numero, code_postal, ville, pays, mail)
        VALUES (:name, :firstName, :address, :number, :zip_code, :city, :country, :email)    
    ");

$stmt->bindParam('name', $name);
$stmt->bindParam('firstName', $firstName);
$stmt->bindParam('address', $address);
$stmt->bindParam('number', $number);
$stmt->bindParam('zip_code', $zip_code);
$stmt->bindParam('city', $city);
$stmt->bindParam('country', $country);
$stmt->bindParam('email', $email);

$result = $stmt->execute();

$sql = "DROP TABLE user";
$db->exec($sql);

$sql = "DROP DATABASE bdd_cours";
$db->exec($sql);
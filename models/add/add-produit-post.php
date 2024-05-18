<?php
include('../../connexion/connexion.php');

if(isset($_POST['valider'])){
    $nom=htmlspecialchars($_POST['nom']);   
    $description=htmlspecialchars($_POST['description']);
    $prix=htmlspecialchars($_POST['prix']);
    $photo=$_FILES['photo']['name'];
    $upload="../../photo/".$photo;
    move_uploaded_file($_FILES['photo']['tmp_name'],$upload);
    //Insertion data from database
    $statut=0;
    #verifier si le client existe ou pas dans la bd
    $getproduits=$connexion->prepare("SELECT * FROM `produits` WHERE nom=? AND statut=?");
    $getproduits->execute([$nom, 0]);
    ($tab=$getproduits->fetch());
    if($tab>0){
        //Cette ligne permet d'ajouter un message dans la session Lors qu'on veut enregistrer ce qui existe
        $_SESSION['msg']= "Ce produits existe deja !";
        header("location:../../views/produits.php");
    }
    else{
        $req=$connexion->prepare("INSERT INTO produits( nom, `description`, Prix, Photo, statut) VALUES (?,?,?,?,?)");
        $resultat=$req->execute([$nom,$description,$prix,$photo,$statut]);
        #Si oui, la variable resultat va retourée true, donc il y a eu un enregistrement
        if($resultat==true){
            $_SESSION['msg']= "L'enreigistrement réussi";//Cette ligne permet d'ajouter un message dans la session Lors qu'il y a eu un enregistrement
            header("location:../../views/produits.php");
        }
        else{
            $_SESSION['msg']= "Echec d'enreigistrement";//Cette ligne permet d'ajouter un message dans la session Lors qu'il n'y a aucun enregistrement
            header("location:../../views/produits.php");
        }
        
    }
    
}else{
    //Cette ligne permet de rediriger l'utiliseteur lors qu'il a pas cliquer sur le button qui sert à enregistrer
    header("location:../../views/produits.php");
}
?> 
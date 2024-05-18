<?php 
    include '../../connexion/connexion.php';
    if(isset($_POST['Enregistrer']))
    {
        $date=date("Y-m-d");
        $produit=htmlspecialchars($_POST['produit']);
        $qte=htmlspecialchars($_POST['qte']);    
        $prix=htmlspecialchars($_POST['prix']);
        $photo=$_FILES['photo']['name'];
        $upload="../../photo/".$photo;
        move_uploaded_file($_FILES['photo']['tmp_name'],$upload); 
        $boutique=htmlspecialchars($_POST['boutique']); 
        $etat=0;
        $statut=0;       
        $req=$connexion->prepare("INSERT INTO `entree`(`date`, `Produit`, `quantite`, `prixAchat`, `boutique`, `etat`, `Statut`, `photo`) VALUES (?,?,?,?,?,?,?,?) ");
        $req->execute(array($date,$produit,$qte,$prix,$boutique,$etat,$statut,$photo));
        if($req){ 
            $_SESSION['msg']="enregistrement reussie";
            header('location:../../views/entree.php');
        }
    }   
    else{
        header('location:../../views/entree.php');
    }
?>
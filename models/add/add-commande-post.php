<?php 
        include_once '../../connexion/connexion.php'; // Appel de la connexion
        // Enregistrement de la commande
        if(isset($_POST['valider'])){
            $date=date('d-m-y');      
            $client=htmlspecialchars($_POST['client']);
            $produit=htmlspecialchars($_POST['produit']);
            $quantite=htmlspecialchars($_POST['Quantité']);
            $details=htmlspecialchars($_POST['details']);
            $Adresse=htmlspecialchars($_POST['Adresse']);
            $telephone=htmlspecialchars($_POST['telephone']);
            $statut=0;
            $Etat=0;
            $req=$connexion->prepare("INSERT INTO `commande`(`date`,`detail`,`produit`,`Quantite`,client,`adresse`,`telephone`,`etat`,`statut`) VALUES (?,?,?,?,?,?,?,?,?)");
            $resultat=$req->execute(array($date,$details,$produit,$quantite,$client,$Adresse,$telephone,$Etat,$statut));
            //$id=$connexion->lastInsertId();
            if($resultat==true){
                $_SESSION['msge']="Votre commande viens d'être enregistrer avec succes";
                //header("location:../../views/commande.php?idcom=$id");
                header("location:../../views/commande.php");
            }
        
        }else{
            header("location:../../views/commande.php");
        }
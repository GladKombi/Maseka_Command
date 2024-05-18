<?php
  include('../../connexion/connexion.php');

  if(isset($_POST['valider'])){
      $nom=htmlspecialchars($_POST['nom']); 
      $postnom=htmlspecialchars($_POST['postnom']);      
      $adresse=htmlspecialchars($_POST['Adresse']);
      $telephone=htmlspecialchars($_POST['telephone']);
      #verifier si le client existe ou pas dans la bd
      $getClients=$connexion->prepare("SELECT * FROM `client` WHERE Adress=? AND telephone=? AND statut=?");
      $getClients->execute([$adresse,$telephone, 0]);
      ($tab=$getClients->fetch());
      if($tab>0){
          $msg='Ce client existe dejà vous devez le selectionner dans la liste';  
          $_SESSION['msg']=$msg;
          header("location:../../views/client.php");
      }else{ 
        //Insertion data from database
        $statut=0;
        $req=$connexion->prepare("INSERT INTO `client`(`nom`, `postnom`, `Adress`, `telephone`, `statut`) VALUES (?,?,?,?,?)");
        $resultat=$req->execute([$nom,$postnom,$adresse,$telephone,$statut]);
        if($resultat==true){
          $_SESSION['msg']="Enregistrement réussie";
            header("location:../../views/client.php");
          }
          else{
              $_SESSION['msg']="Echec d'enregistrement";
              header("location:../../views/client.php");
          }
      }
  }
  else{
    header('location:../../views/client.php');
  }
?>
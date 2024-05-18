<?php
  include('../../connexion/connexion.php');
  if(isset($_POST['valider']) && !empty($_GET['idclient'])){
    $id=$_GET['idclient'];
    $nom=htmlspecialchars($_POST['nom']);
    $postnom=htmlspecialchars($_POST['postnom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $genre=htmlspecialchars($_POST['genre']);
    $adresse=htmlspecialchars($_POST['adresse']);
    $telephone=htmlspecialchars($_POST['telephone']);
    //select data from database
    $req=$connexion->prepare("UPDATE `client` SET  nom=?,postnom=?,prenom=?,genre=?,adresse=?,telephone=? WHERE id='$id'");
    $req->execute([$nom,$postnom,$prenom,$genre,$adresse,$telephone]);
    if($req==true){
      $msg="Modification réussie";
      $_SESSION['msg']=$msg;
      header("location:../../views/client.php");
    }
  }
  else{
    header("location:../../views/client.php");
  }
?>
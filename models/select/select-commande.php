<?php
    if (isset($_GET['idCom'])){
        $id=$_GET['idCom'];
        $getDataMod=$connexion->prepare("SELECT * FROM commande WHERE id=?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();
        /**
         * Ici je specifie le lien lors qu'il s'agit de la modification, ce lien montre ou il faut allez faire la modification 
         * Et changer le texte de bouton pour que les utiliseures sachent s'il s'agit de quel action
         */
        $url="../models/updat/up-commande-post.php?idCom=".$id;
        $btn="Modifier";
        $title="Modifier Commande";
    }
    else{
        /**
         * Ici je specifie le lien lors qu'il s'agit de l'enregistrement, ce lien montre ou il faut allez faire l'enregistrement 
         * Et changer le texte de bouton pour que les utiliseures sachent s'il s'agit de quel action
         */
        $url="../models/add/add-commande-post.php";
        $btn="Enregistrer";
        $title="Enregister une Commande";
    }

    /**
     * Le code qui permet d'afficher les client, lors de l'affichage simple, et lors de la recherche
     */
    if(isset($_GET['search']) && !empty($_GET['search'])){
        // $search=$_GET['search'];
        // $getData=$connexion->prepare("SELECT  catproduit.`description`, typeproduit.description,catproduit.id  FROM typeproduit,`catproduit`  
        // WHERE catproduit.typeproduit=typeproduit.id AND produit.supprimer=? AND typeproduit.statut=? AND (catproduit.`nom` LIKE ? OR 
        // produit.`seuil` LIKE ? OR typeproduit.description LIKE ?)");
        // $getData->execute([0, 0, "%". $search."%", "%". $search."%", "%". $search."%" ]);
    }
    else{
        $statut=0;
        $etat=0;
        $getData=$connexion->prepare("SELECT commande.id, commande.date, produits.nom, produits.description, produits.Prix, produits.id, commande.detail, commande.produit, commande.Quantite, commande.client, client.nom, client.id, commande.adresse, commande.telephone, commande.etat, commande.statut FROM commande,produits,client WHERE commande.produit=produits.id AND commande.client=client.id AND commande.statut=? AND commande.etat=?;");
        $getData->execute([$statut,$etat]);
        // $getData=$connexion->prepare("SELECT  catproduit.`description`, typeproduit.description,catproduit.id  FROM typeproduit,`catproduit` 
        // WHERE catproduit.typeproduit=typeproduit.id AND catproduit.supprimer=? AND typeproduit.statut=?");
        // $getData->execute([0, 0]);
        
    }
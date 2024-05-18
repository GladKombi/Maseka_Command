<?php
    if (isset($_GET['idClient'])){
        $id=$_GET['idClient'];
        $getDataMod=$connexion->prepare("SELECT * FROM client WHERE id=?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();
        /**
         * Ici je specifie le lien lors qu'il s'agit de la modification, ce lien montre ou il faut allez faire la modification 
         * Et changer le texte de bouton pour que les utiliseures sachent s'il s'agit de quel action
         */
        $url="../models/updat/up-client-post.php?idClient=".$id;
        $btn="Modifier";
        $title="Modifier Client";
    }
    else{
        /**
         * Ici je specifie le lien lors qu'il s'agit de l'enregistrement, ce lien montre ou il faut allez faire l'enregistrement 
         * Et changer le texte de bouton pour que les utiliseures sachent s'il s'agit de quel action
         */
        $url="../models/add/add-client-post.php";
        $btn="Enregistrer";
        $title="Ajouter Client";
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
        $getData=$connexion->prepare("SELECT * FROM client WHERE statut=?");
        $getData->execute([0]);
        // $getData=$connexion->prepare("SELECT  catproduit.`description`, typeproduit.description,catproduit.id  FROM typeproduit,`catproduit` 
        // WHERE catproduit.typeproduit=typeproduit.id AND catproduit.supprimer=? AND typeproduit.statut=?");
        // $getData->execute([0, 0]);
        
    }
<?php 
    include '../connexion/connexion.php';//Se connecter à la BD
    require_once('../models/select/select-categorie.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Catégories</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <?php require_once('style.php') ?>
</head>

<body>

    <!-- Appel de menues  -->
    <?php require_once('aside.php') ?>

    <main id="main" class="main">
        <div class="row">
            <div class="col-12">
                <h4 class=""><?=$title?></h4>
            </div>
            <!-- pour afficher les massage  -->
            <?php                
                if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])){
                    ?><div class="alert-info alert text-center"><?=$_SESSION['msg']?></div><?php
                }
                unset($_SESSION['msg']);#Cette ligne permet de vider la valeur qui se trouve dans la session message
            ?>
           
            <!-- Le form qui enregistrer les données  -->
            <div class="col-xl-4 col-lg-4 col-md-6">
                <form class="shadow p-3" action="<?=$url?>" method="POST">
                    <div class="row">
                        <div class="col-12 p-3">
                            <label for="">Description <span class="text-danger">*</span></label>
                            <input autocomplete="off" required type="text" class="form-control" placeholder="Entrez la description"
                                name="description" <?php if (isset($_GET['idcat'])) { ?>
                                value="<?php echo $tab['description']; ?> <?php }?>">
                        </div>
                        <div class="col-12 p-3">
                            <input type="submit" class="btn btn-dark w-100" name="valider" value="<?=$btn?>">
                        </div>
                    </div>
                </form>
            </div>
            <!-- La table qui affiche les données  -->
            <div class="col-xl-8 col-lg-8 col-md-6 table-responsive px-3">
                <table class="table table-sm text-center shadow">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $n=0;                            
                            $getData=$connexion->prepare("SELECT * from typeproduit WHERE statut=0");
                            $getData->execute();
                            while($idbout=$getData->fetch()){
                                $n++;
                                ?>
                                    <tr>
                                        <th scope="row"><?= $n;?></th>
                                        <td> <?= $idbout["description"] ?></td>
                                        <td>
                                            <a href='categories.php?idcat=<?=$idbout['id'] ?>' class="btn btn-dark btn-sm "><i
                                                        class="bi bi-pencil-square"></i></a>
                                            <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')"
                                                    href='../models/delete/deletecat.php?idSupcat=<?=$idbout['id'] ?>' class="btn btn-danger btn-sm "><i
                                                        class="bi bi-trash3-fill"></i></a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main><!-- End #main -->

    <?php require_once('script.php') ?>

</body>

</html>
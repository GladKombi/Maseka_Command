<?php 
    include '../connexion/connexion.php';//Se connecter à la BD
    #Appel de la page qui permet de faire les affichages
    require_once('../models/select/select-boutique.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?=$title?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <?php require_once('style.php'); ?>
</head>

<body>

    <!-- Appel de menues  -->
    <?php require_once('aside.php') ?>

    <main id="main" class="main">
        <div class="row">
            <div class="col-12">
                <h4><?=$title?></h4>
            </div>
            <!-- pour afficher les massage  -->
            <?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])){ 
                    ?> <div class="alert-info alert text-center"><?php echo $_SESSION['msg'];?> </div><?php 
                } 
                unset($_SESSION['msg']);
            ?>
            <!-- Le form qui enregistrer les données  -->
            <div class="col-xl-12 ">
                <form class="shadow p-3" method="POST" action="<?=$url?>">
                    <div class="row">
                        <!-- script pour affichage du form modif soit enreg -->
                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                            <label for="">Nom <span class="text-danger">*</span></label>
                            <input autocomplete="off" required type="text" class="form-control"
                                placeholder="Ex: Boutique 1" name="nom" <?php if (isset($_GET['idbout'])) { ?>
                                value="<?php echo $tab['nom']; ?> <?php }?>">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                            <label for="">Description <span class="text-danger">*</span></label>
                            <input autocomplete="off" required type="text" class="form-control"
                                placeholder="EX: Boutique d'habillements" name="description"
                                <?php if (isset($_GET['idbout'])) { ?>
                                value="<?php echo $tab['description']; ?> <?php }?>">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                            <label for="">Adresse <span class="text-danger">*</span></label>
                            <input autocomplete="off" required type="text" class="form-control"
                                placeholder="Ex: Av. Bayé" name="adresse" <?php if (isset($_GET['idbout'])) { ?>
                                value="<?php echo $tab['adress']; ?> <?php }?>">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 mt-4 col-sm-6 p-3">
                            <input type="submit" class="btn btn-dark w-100" value="<?=$btn?>" name="valider">
                        </div>
                    </div>
                </form>
            </div>
            <!-- La table qui affiche les données  -->
            <div class="col-xl-12 table-responsive px-3 mt-3">
                <table class="table table-sm text-center shadow">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Adresse</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $n=0;
                            while($idbout=$getData->fetch()){
                                $n++;
                                ?>
                                    <tr>
                                        <th scope="row"><?= $n;?></th> 
                                        <td> <?= $idbout["nom"] ?></td>                                       
                                        <td> <?= $idbout["description"] ?></td>
                                        <td> <?= $idbout["adress"] ?></td>
                                        <td>
                                            <a href='boutique.php?idbout=<?=$idbout['id'] ?>' class="btn btn-dark btn-sm "><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')"
                                                href="../models/delete/del-boutique-post.php?idSupcat=<?=$idbout['id'] ?>"
                                                class="btn btn-danger btn-sm "><i class="bi bi-trash3-fill"></i></a>
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
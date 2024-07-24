<?php

 $Users = new Users();
 $LignesFactures = new LignesFactures();

 $users = $Users->getAll();
 $Factures = $LignesFactures->getAll();

?>


<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Création Factures</span>
            </div>
        </div>
    </div>
    <div class="card-body"> 
        <div class="tab-content">
            <div class="tab-pane active">
                <table class="table">
                    <tbody>
                    <?php
                    if(!empty($Factures['datas'])){
                        foreach($Factures['datas'] as $el){?>
                            <tr>
                                <td><i class="fas fa-arrows-alt"></i></td>
                                <td><?=substr(@$el->libelle , 0, 50); ?></td>
                                <td class="td-actions text-right">
                                    <a href="<?= $_SERVER['REQUEST_URI'] ?>/set/<?= $el->id ?>" class="btn btn-warning btn-link btn-lg"><i class="fas fa-pen"></i></a>
                                    <a href="<?= $_SERVER['REQUEST_URI'] ?>/delete/<?= $el->id ?>" onclick="return confirm('Êtes-vous de vouloir effectuer cette action ?')" class="btn btn-danger btn-link btn-lg"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                        <?php }
                    }else{?>
                        <tr>
                            <td class="text-center h4">Aucun article</td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

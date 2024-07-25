<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Articles</span>
                <ul class="nav nav-tabs float-right">
                    <li class="nav-item mr-3"><a class="nav-link active" href="javascript:history.go(-1)" ><i class="fas fa-arrow-left"></i> Retour</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= $_SERVER['REQUEST_URI'] ?>/set" ><i class="material-icons">code</i> Nouvel article</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active">
                <table class="table">
                    <tbody>
                    <?php
                    if(!empty($data['datas'])){
                        foreach($data['datas'] as $el){?>
                            <tr>
                                <td><i class="fas fa-arrows-alt"></i></td>
                                <td><?=substr(@$el->title , 0, 50); ?></td>
                                <td>Publié : <?= (@$el->active)? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'; ?></td>
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
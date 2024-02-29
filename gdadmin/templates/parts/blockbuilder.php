<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Blocks</span>
                <ul class="nav nav-tabs float-right">
                    <li class="nav-item mr-3"><a class="nav-link active" href="javascript:history.go(-1)" ><i class="fas fa-arrow-left"></i> Retour</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= ADMIN_URL ?>blockBuilder/set" ><i class="material-icons">code</i> Nouveau block</a></li>
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
                    if(!empty($data['blocks'])){
                    foreach($data['blocks'] as $el){?>
                    <tr>
                        <td><i class="fas fa-arrows-alt"></i></td>
                        <td><?=substr(@$el->nom , 0, 30); ?>  <?php if (!isset($data['used_blocks'][$el->id])) {?><span title="Bloc non utilisé">&#10060;</span><?php }else{?><span title="Bloc utilisé en front">&#10004;</span><?php }?></td>
                        <td><?=substr(@$el->description , 0, 30); ?></td>
                        <td class="td-actions text-right">
                            <a href="<?= ADMIN_URL ?>blockBuilder/set/<?= $el->id ?>" class="btn btn-warning btn-link btn-lg"><i class="fas fa-pen"></i></a>
                            <a href="<?= ADMIN_URL ?>blockBuilder/delete/<?= $el->id ?>" onclick="return confirm('Êtes-vous de vouloir effectuer cette action ?')" class="btn btn-danger btn-link btn-lg"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                    <?php }
                    }else{?>
                        <tr>
                            <td class="text-center h4">Aucun block</td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

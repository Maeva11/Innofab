<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Prise de rendez-vous</span>
                <ul class="nav nav-tabs float-right">
                    <li class="nav-item mr-3"><a class="nav-link active" href="javascript:history.go(-1)"><i class="fas fa-arrow-left"></i> Retour</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= $_SERVER['REQUEST_URI'] ?>/set"><i class="material-icons">code</i> Nouveau Rendez-vous</a></li>
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
                        if (!empty($data['datas'])) {
                            foreach ($data['datas'] as $el) {
                                $dateObj = DateTime::createFromFormat('Y-m-d', $el->dateRendezVous);
                                ?>
                                <tr>
                                    <td><i class="fas fa-arrows-alt"></i></td>
                                    <td><?= substr(@$el->nom, 0, 50); ?> <?= substr(@$el->prenom, 0, 50); ?></td>
                                    <td><?= substr(@$el->email, 0, 50); ?></td>
                                    <td>Le : <?= $dateObj->format('d/m/Y') ?> à <?= @$el->heureDebut ?></td>
                                    <td>Accepté : <?= (@$el->accept) ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'; ?></td>
                                    <td class="td-actions text-right">
                                        <form method="post" action="<?= ADMIN_URL ?>crud/priseRendezVous/set" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= @$el->id ?>">
                                            <input type="hidden" name="statut" value="1">
                                            <input type="hidden" name="email" value="<?= @$el->email ?>">
                                            <button type="submit" class="btn btn-success btn-link btn-lg"><i class="fas fa-check"></i></button>
                                        </form>
                                        <form method="post" action="<?= ADMIN_URL ?>crud/priseRendezVous/set" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= @$el->id ?>">
                                            <input type="hidden" name="statut" value="0">
                                            <input type="hidden" name="email" value="<?= @$el->email ?>">
                                            <button type="submit" class="btn btn-danger btn-link btn-lg"><i class="fas fa-times"></i></button>
                                        </form>
                                        <a href="<?= $_SERVER['REQUEST_URI'] ?>/set/<?= $el->id ?>" class="btn btn-warning btn-link btn-lg"><i class="fas fa-pen"></i></a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td class="text-center h4">Aucun rendez-vous</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
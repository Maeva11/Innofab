
<?php /**<ul>
 * <?php foreach ((new Pagebuilder())->getAll('menu', 'asc') as $menu) {
 * if (!empty($menu->menu)) {
 * $children = @(new Pagebuilder())->getChildren($menu->id);
 * ?>
 * <li class="<?= (!empty($children)) ? "dropdown" : "" ?>">
 * <a href="<?= $menu->url ?>"><?= $menu->nom ?></a>
 * <?php if (!empty($children)) { ?>
 * <ul>
 * <?php foreach ($children as $el) { ?>
 * <li><a href="<?= $el->url ?>"><?= $el->nom ?></a></li>
 * <?php } ?>
 * </ul>
 * <?php } ?>
 * </li>
 * <?php
 * }
 * }
 * ?>
 * </ul>**/ ?>

test 

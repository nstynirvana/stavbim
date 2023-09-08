<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?$countLinks = count($arResult);?>

<?$halfMenu = round($countLinks/2);?>
<?$secondMenu = $countLinks-$halfMenu;?>
<?$counter = 0;?>

<? if (!empty($arResult)): ?>
    <? foreach ($arResult as $i => $arItem): ?>
        <?if($counter == 0 or $counter == $halfMenu):?>
            <ul class="footer__list">
        <?endif;?>
            <li class="footer__item"><a href="<?= $arItem["LINK"] ?>"class="footer__item__link"><?= $arItem["TEXT"] ?></a></li>
        <?$counter++;?>
        <?if($counter == $halfMenu or $counter == $countLinks):?>
            </ul>
        <?endif;?>
    <? endforeach ?>
<? endif; ?>
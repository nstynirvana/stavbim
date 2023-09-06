<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <ul class="footer__list__mobile">
        <? foreach ($arResult as $i => $arItem): ?>
            <li class="footer__item"><a href="<?= $arItem["LINK"] ?>"class="footer__item__link"><?= $arItem["TEXT"] ?></a></li>
        <? endforeach ?>
    </ul>
<? endif; ?>

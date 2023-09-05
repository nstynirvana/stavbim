<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <div class="item__catalog__content-block-mobile-filter-main__kind__title item__catalog-accord-title active">
        <p><?= $arSection["NAME"] ?></p>
        <span></span>
    </div>
    <ul class="item__catalog__content-block-mobile-filter-main__kind__descr item__catalog-accord-descr active">
        <? foreach ($arResult as $i => $arItem): ?>
            <li class="item__catalog__content-block-mobile-filter-main__kind__descr-link"><a href="<?= $arItem["LINK"] ?>"class=""><?= $arItem["TEXT"] ?></a></li>
        <? endforeach ?>
    </ul>
<? endif; ?>

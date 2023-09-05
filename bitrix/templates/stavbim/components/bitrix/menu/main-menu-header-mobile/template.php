<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<? $counter = 0; ?>
<? $countElements = count($arResult); ?>

<div class="mobile__menu__wrapper">
    <div class="mobile__menu">

        <? if (!empty($arResult)): ?>
        <? foreach ($arResult

        as $i => $arItem): ?>
        <? if ($counter == 0): ?>
        <ul class="mobile__menu__list">
            <? endif; ?>
            <? if ($counter < 6): ?>
                <li class="mobile__menu__list-item"><a href="<?= $arItem["LINK"] ?>"class="mobile__menu__link"><?= $arItem["TEXT"] ?></a></li>
            <? endif; ?>
            <? if ($counter == 6): ?>
            <li class="mobile__menu__list-item">
                <div class="mobile__menu__link mobile__more">Ещё <span>+</span></div>
            </li>
        </ul>
        <div class="mobile__menu__change-language">
            <a href="#" class="mobile__menu__change-language-btn active"><p>RUS</p></a>
            <a href="/en<?= $_SERVER["REQUEST_URI"] ?>" class="mobile__menu__change-language-btn"><p>ENG</p></a>
        </div>
    </div>
</div>
<div class="mobile__menu__more__wrapper">
<div class="mobile__menu__more">
<div data-closeMoreMenu class="close__mobile__menu__more">
    <svg data-closeMoreMenu width="17" height="14" viewBox="0 0 17 14" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path d="M17 7H1M1 7L7 1M1 7L7 13" stroke="currentColor"/>
    </svg>
    <div data-closeMoreMenu class="close__mobile__menu__more__text">Назад</div>
</div>
<ul class="mobile__menu__more__list">
<? endif; ?>

<? if ($counter >= 6): ?>
    <li class="droplist__item"><a href="<?= $arItem["LINK"] ?>"class="mobile__menu__more__link"><?= $arItem["TEXT"] ?></a></li>
<? endif; ?>
<? $counter++; ?>
<? if ($counter == $countElements): ?>
    </ul>
    </div>
    </div>
<? endif; ?>
<? endforeach ?>
<? endif; ?>

<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?$counter = 0;?>
<?$countElements = count($arResult);?>

<? if (!empty($arResult)): ?>
    <? foreach ($arResult as $i => $arItem): ?>
        <?if($counter == 0):?>
            <ul class="header__list">
        <?endif;?>
            <?if($counter < 6):?>
                <li class="header__list-item"><a href="<?= $arItem["LINK"] ?>"class="header__link"><?= $arItem["TEXT"] ?></a></li>
            <?endif;?>
        <?if($counter == 6):?>
                <li class="header__list-item link-more"><a class="header__link">Eщё</a></li>
            </ul>
            <div class="droplist__wrapper">
                <div id="content" class="container">
                    <div class="droplist">
                        <ul class="droplist__list">
        <?endif;?>

                        <?if($counter >= 6):?>
                            <li class="droplist__item"><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                        <?endif;?>
        <?$counter++;?>
        <?if($counter == $countElements):?>
                        </ul>
                    </div>
                </div>
            </div>
        <?endif;?>
    <? endforeach ?>
<? endif; ?>

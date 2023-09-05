<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

    <div class="item__catalog__filter-block__kind__title item__catalog-accord-title active">
        <p style="margin: 0;">
            <?= $arResult["SECTION"]['NAME'] ?>
        </p><span></span>
    </div>

    <ul class="item__catalog__filter-block__kind__descr item__catalog-accord-descr active">
        <? foreach ($arResult["SECTIONS"] as $arSection): ?>

            <?/* dp($arSection) */?>
            <li class="item__catalog__filter-block__kind__descr-link" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
                <a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?= $arSection["NAME"] ?></a>
            </li>
        <? endforeach; ?>
    </ul>


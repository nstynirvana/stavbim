<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?/*
echo "<pre>";
print_r($arSection);
echo "</pre>";*/
?>

<? foreach ($arResult["SECTIONS"] as $arSection): ?>
        <div class="item__catalog__content-block-preview">
            <div class="item__catalog__content-block-preview-img"><img src="<?= $arSection["PICTURE"]["SRC"] ?>" alt=""></div>
            <div class="item__catalog__content-block-preview-text">
                <h1 class="item__catalog__content-block-preview-text__title"><?= $arSection["NAME"] ?></h1>
                <h2 class="item__catalog__content-block-preview-text__descr"><?= $arSection["DESCRIPTION"] ?></h2>
            </div>
        </div>
<? endforeach; ?>


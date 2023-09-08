<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<section class="catalog">
    <div class="container">
        <h2 class="catalog__title">Каталог</h2>
        <div class="catalog__cards-block">
            <?foreach($arResult["SECTIONS"] as $arSection):?>
                <?if($arSection["DEPTH_LEVEL"] == 2):?>
                    <div class="catalog__card" style="height: auto;" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
                        <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="catalog__card-wrapper">
                            <div class="catalog__card-img">
                                <?$arFile = CFile::GetFileArray($arSection["DETAIL_PICTURE"]);?>
                                <img src="<?=$arSection["PICTURE"]["SRC"]?>" alt="<?=$arSection["PICTURE"]["ALT"]?>" class="catalog__card-img-desc">
                                <img src="<?=$arFile["SRC"]?>" alt="<?=$arSection["PICTURE"]["ALT"]?>" class="catalog__card-img-tablet">
                            </div>
                            <div class="catalog__card-descr"><p><?=$arSection["NAME"]?></p></div>
                        </a>
                    </div>
                <?endif;?>
            <?endforeach;?>
        </div>
    </div>
</section>
<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? foreach ($arResult["SECTIONS"] as $arSection): ?>

    <?//echo "<pre>"; print_r($arSection); echo "</pre>";?>

    <section class="main-catalog" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
        <? if ($arSection["UF_CUSTOME_NAME"] != "") {
            $name = htmlspecialchars_decode($arSection["UF_CUSTOME_NAME"]);
        } else {
            $name = $arSection["NAME"];
        } ?>
        <h2 class="main-catalog__title"><?= $name ?></h2>

        <div class="main-catalog__cards-block">

            <?
            $arChildFilter = array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'SECTION_ID' => $arSection["ID"]);
            $arChildSections = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arChildFilter, true);
            while ($childSection = $arChildSections->GetNext()) {
                ?>
                <? /*   echo "<pre>"; print_r($childSection); echo "</pre>";*/?>
                <div class="catalog__card">
                    <a href="<?=$childSection["SECTION_PAGE_URL"] ?>" class="catalog__card-wrapper">
                        <div class="catalog__card-img">
                            <? $arFile_1 = CFile::GetFileArray($childSection["PICTURE"]); ?>
                            <? $arFile_2 = CFile::GetFileArray($childSection["DETAIL_PICTURE"]); ?>
                            <img src="<?= $arFile_1["SRC"] ?>" class="catalog__card-img-desc" alt="">
                            <img src="<?= $arFile_2["SRC"] ?>" class="catalog__card-img-tablet" alt="">
                        </div>
                        <div class="catalog__card-descr"><p><?= $childSection["NAME"] ?></p></div>
                    </a>


                    <div class="accordion__wrapper openable">
                        <?
                        $counter = 0;
                        $resultCounter = 0;
                        $arrSectionsInside = array();
                        $arGrandchildFilter = array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'SECTION_ID' => $childSection["ID"]);
                        $arGrandchildSections = CIBlockSection::GetList(false, $arGrandchildFilter);
                        while ($GrandchildSection = $arGrandchildSections->GetNext()) {
                            $resultCounter++;
                            $arrSectionsInside[] = $GrandchildSection;
                        }

                        foreach($arrSectionsInside as $GrandchildSection){
                            ?>
                            <? if ($counter < 4): ?>
                                <div class="accordion__link">
                                    <a href="<?= $GrandchildSection["SECTION_PAGE_URL"] ?>"><?= $GrandchildSection["NAME"] ?></a>
                                </div>
                            <? else: ?>
                                <? if ($counter == 4) { ?><div class="accordion__hidden"><? } ?>
                                <div class="accordion__hidden__link">
                                    <a href="<?= $GrandchildSection["SECTION_PAGE_URL"] ?>"><?= $GrandchildSection["NAME"] ?></a>
                                </div>
                                <? if ($counter == $resultCounter-1) { ?></div><? } ?>
                            <?endif; ?>

                            <?

                            $counter++;

                        }
                        ?>
                        <? if ($counter > 4) { ?>
                            <div class="accordion__more-btn">Показать еще</div>
                        <? } ?>

                    </div>
                </div>
            <? } ?>
        </div>
    </section>
<? endforeach; ?>

<div class="container">
    <? $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "breadcrumbs",
        array(
            "COMPONENT_TEMPLATE" => "breadcrumbs",
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "s1"
        ),
        false
    ); ?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
    <div class="robo-cancel"><p>Ваш платёж не прошёл.</p>
        <p>Пожалуйста, свяжитесь с нашим менеджером!</p></div>

    <style>


        .robo-cancel {
            background-position: center top;
            background-repeat: no-repeat;
            font-family: roboto, helvetica, sans-serif;
            font-size: 18px;
            font-weight: 300;
            padding-top: 200px;
            text-align: center;
        }

        .robo-sucsess p:first-child {
            color: #6c9814;
        }

        .robo-cancel {
            background-image: url("robo-cancel.png");
        }

        .robo-cancel p:first-child {
            color: #c11212;
        }

        .robo-sucsess p,
        .robo-cancel p {
            text-indent: 0;
        }

        .robo-sucsess p:first-child,
        .robo-cancel p:first-child {
            font-size: 28px;
            margin-bottom: 20px;
        }
    </style>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
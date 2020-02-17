<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap&subset=cyrillic');
        html, body, * {
            font-family: 'Montserrat', sans-serif;
        }
        .background {
            background-image: url('https://api.excursguide.ru/images/mails/confirm.png');
            background-position: center center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
<table width="100%" bgcolor="#f4f4f4" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader" >
    <tbody>
    <tr>
        <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                <tbody>
                <tr>
                    <td width="100%">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                            <tbody>
                            <!-- Spacing -->
                            <tr>
                                <td width="100%" height="40"></td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td width="100%" align="cener" valign="middle" style="text-align: center; font-size: 13px;color: #282828" st-content="preheader">
                                    <a href="https://excursguide.ru/" class="logo" style="
                                                padding: 1.125rem .625rem; border-radius: 15px;
                                                background-color: #ff7555; font-size: 1.25rem;
                                                font-weight: 500; text-decoration: none;
                                                color: #fff; display: inline-block;">EG</a>
                                </td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td width="100%" height="20"></td>
                            </tr>
                            <!-- Spacing -->
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>

<table width="100%" bgcolor="#f4f4f4" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader" >
    <tbody>
    <tr>
        <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                <tbody>
                <tr>
                    <td width="100%">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                            <tbody>
                            <!-- Spacing -->
                            <tr>
                                <td width="100%" height="20"></td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td width="100%" class="background" height="250px" bgcolor="#405089" valign="middle" style="border-radius: 25px 25px 0 0; background-color: #405089; text-align: center; font-size: 13px;color: #282828" st-content="preheader">

                                </td>
                            </tr>

                            <tr>
                                <td width="100%" bgcolor="#ffffff" style="border-radius: 0 0 25px 25px; padding: 30px; background-color: #ffffff;">
                                    <h2 style="color: #405089; margin-bottom: 20px; font-weight: 500; font-size: 22px;">
                                        Привет, {{ $name }}
                                    </h2>

                                    <p style="color: #585f76; margin-bottom: 0px;">На связи команда Excursguide.ru</p>
                                    <p style="color: #585f76; margin-bottom: 40px;">Надеемся, что тебе нравится пользоваться нашим сайтом, ведь мы очень старались!</p>

{{--                                    <div style="background-color: #cccccc; height: 1px; margin-top: 40px; margin-bottom: 40px;"></div>--}}

                                    <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                        <tbody>
                                        <tr>
                                            <td width="65%">
                                                <h4>Как правильно оформить твой профиль для того, чтобы получать больше заказов?</h4>

                                                <ol style="margin-left: 15px;padding-left: 0;">
                                                    <li style="color: #585f76; font-size: 14px; margin-bottom: 10px;">Используй только качественные фотографии в профиле и экскурсиях</li>
                                                    <li style="color: #585f76; font-size: 14px; margin-bottom: 10px;">Размести на сайте все свои экскурсии, чтобы получать больше заинтересованных клиентов</li>
                                                    <li style="color: #585f76; font-size: 14px; margin-bottom: 10px;">Максимально подробно, интересно и в ярких красках опиши каждую экскурсию</li>
                                                    <li style="color: #585f76; font-size: 14px; margin-bottom: 10px;">Укажи как можно больше контактов на случай того, если у туриста не все возможности связаться с тобой</li>
                                                    <li style="color: #585f76; font-size: 14px; margin-bottom: 10px;">Заходи как можно чаще к нам на сайт для того, чтобы не пропустить
                                                        сообщения в нашем мессенджере для общения с туристами. Это можно делать
                                                        и с телефона, ведь наш сайт адаптирован под мобильную версию!</li>
                                                </ol>


                                            </td>

                                            <td width="35%">
                                                <img src="https://api.excursguide.ru/images/mails/persons/6.jpeg" alt="" width="100%">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <div style="background-color: #cccccc; height: 1px; margin-top: 40px; margin-bottom: 40px;"></div>

                                    <h4>Почему мы?</h4>
                                    <p style="color: #585f76; margin-bottom: 20px;">Excursguide - агрегатор для размещения туристических услуг.</p>

                                    <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" valign="center" class="devicewidth">
                                        <tbody>
                                        <tr>
                                            <td width="60%">
                                                <ol style="margin-left: 15px;padding-left: 0;">
                                                    <li style="color: #585f76; font-size: 14px; margin-bottom: 10px;">
                                                        Использование сервиса абсолютно <strong>бесплатно</strong>!
                                                        (Мы не берем комиссии за бронь экскурсии и плату за размещение.
                                                        Платите только за продвижение внутри сайта)
                                                    </li>
                                                    <li style="color: #585f76; font-size: 14px; margin-bottom: 10px;">
                                                        Зарегистрироваться на сайте может <strong>любой желающий</strong>. Как частный гид, так и организатор туров.
                                                    </li>
                                                    <li style="color: #585f76; font-size: 14px; margin-bottom: 10px;">
                                                        <strong>Общение с клиентами</strong> происходит в режиме <strong>он-лайн</strong> в чате на сайте.
                                                    </li>

                                                </ol>
                                            </td>

                                            <td width="40%">
                                                <img src="https://api.excursguide.ru/images/mails/persons/7.png" alt="" width="100%">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <div style="margin-top: 20px; margin-bottom: 20px;"></div>

                                    <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                        <tbody>
                                        <tr>
                                            <td width="40%">
                                                <div style="margin-right: 20px">
                                                    <img src="https://api.excursguide.ru/images/mails/persons/8.png" alt="" width="100%">
                                                </div>
                                            </td>

                                            <td width="60%">
                                                <ol style="margin-left: 15px;padding-left: 0;" start="4">
                                                    <li style="color: #585f76; font-size: 14px; margin-bottom: 10px;">
                                                        Загружать на сайт разрешено <strong>неограниченное</strong> количество экскурсий.
                                                        Достаточно выбрать категорию экскурсии, поставить стоимость и
                                                        фотографию и добавить необходимую информацию на сайт.
                                                    </li>
                                                    <li style="color: #585f76; font-size: 14px; margin-bottom: 10px;">
                                                        Контактная информация гида в <strong>открытом доступе</strong>. Клиент может связаться с гидом напрямую.
                                                    </li>
                                                    <li style="color: #585f76; font-size: 14px; margin-bottom: 10px;">
                                                        Информацию на сайте можно использовать как визитную карточку гида.
                                                    </li>
                                                    <li style="color: #585f76; font-size: 14px; margin-bottom: 10px;">
                                                        Возможность оплаты через Безопасную Сделку на сайте (еще в разработке).
                                                    </li>
                                                </ol>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <div style="background-color: #cccccc; height: 1px; margin-top: 40px; margin-bottom: 40px;"></div>

                                    <p style="color: #585f76; margin-bottom: 20px;">
                                        Рекомендуем раз в неделю обновлять информацию в профиле и добавлять новые услуги.
                                    </p>

                                    <p style="color: #585f76; margin-bottom: 20px;">
                                        ____<br/><br/>
                                        С уважением к тебе и твоей работе,<br/>
                                        команда <a href="https://excursguide.ru" style="color: #405089;">Excursguide.ru</a>
                                    </p>

                                </td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td width="100%" height="20"></td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td>
                                    <p style="text-align: center; color: #cccccc; margin-bottom: 20px;">
                                        © {{ now()->year }} Excursguide.ru. Все права защищены
                                    </p>
                                </td>
                            </tr>

                            <!-- Spacing -->
                            <tr>
                                <td width="100%" height="50"></td>
                            </tr>
                            <!-- Spacing -->
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>

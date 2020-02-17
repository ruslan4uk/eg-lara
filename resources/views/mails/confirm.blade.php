<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap&subset=cyrillic');
        html, body, * {
            font-family: 'Montserrat', sans-serif;
        }
        .background {
            background-image: url('https://api.excusguide.ru/images/mails/confirm.png');
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

                                            <h2 style="color: #405089; margin-bottom: 20px; font-weight: 500; font-size: 22px;">Здравствуйте, {{ $name }}!</h2>

                                            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" valign="center" class="devicewidth">
                                                <tbody>
                                                <tr>
                                                    <td width="40%">
                                                        <img src="https://api.excusguide.ru/images/mails/persons/confirm.jpg" alt="" width="100%">
                                                    </td>

                                                    <td width="60%">
                                                        <p style="color: #585f76; margin-bottom: 20px;">
                                                            Меня зовут Мила Лукьянова и я основатель проекта
                                                            <a href="https://excursguide.ru" style="color: #405089;">Excursguide.ru</a>.
                                                        </p>

                                                        <p style="color: #585f76; margin-bottom: 20px;">
                                                            Добро пожаловать к нам в Excursguide — сервис, где гиды и туристы открывают новые границы путешествий.
                                                        </p>

                                                        <p style="color: #585f76; margin-bottom: 20px;">Чтобы пройти регистрацию, подтвердите свой эл.адрес.</p>

                                                        <a href="https://excursguide.ru/auth/confirm?mail={{ $email }}&hash={{ $hash }}" target="_blank" style="line-height: 16px; display:inline-block; padding: 13px 22px; color: #ffffff; background-color: #405089; border-radius: 25px; font-size: 16px; text-decoration: none;">Подтвердить</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                            <p style="color: #585f76; margin-bottom: 20px;">
                                                Размещение экскурсий на нашем сайте совершенно бесплатно и твои контакты будут находиться в открытом доступе.
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

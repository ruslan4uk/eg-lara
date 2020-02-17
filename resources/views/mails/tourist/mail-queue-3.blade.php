<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap&subset=cyrillic');
        html, body, * {
            font-family: 'Montserrat', sans-serif;
        }
        .background {
            background-image: url('{{ asset('images/mails/confirm.png')  }}');
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

                                    <p style="color: #585f76; margin-bottom: 20px;">
                                        На связи команда Excursguide.ru!<br/>
                                        Решили тебе помочь и написали инструкцию:
                                    </p>

                                    <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                        <tbody>
                                        <tr>
                                            <td width="65%">
                                                <h4>Как выбрать лучшего гида и экскурсию у нас на сайте?</h4>

                                                <p style="color: #585f76; margin-bottom: 20px;">
                                                    Напомним, что Excursguide - социальная сеть сеть для путешественников!
                                                    Теперь найти подходящего гида и экскурсию стало легко и очень удобно.
                                                    И, что тоже важно, использование сервиса абсолютно <strong>бесплатно</strong>.
                                                </p>

                                                <p style="color: #585f76; margin-bottom: 20px;">
                                                    На нашем сайте только гиды - энтузиасты в мире туризма, великолепные рассказчиков и потрясающие путеводителей.
                                                </p>
                                            </td>

                                            <td width="35%">
                                                <img src="{{ asset('images/mails/persons/6.jpeg')  }}" alt="" width="100%">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>



                                    <div style="background-color: #cccccc; height: 1px; margin-top: 40px; margin-bottom: 20px;"></div>

                                    <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" valign="center" class="devicewidth">
                                        <tbody>
                                        <tr>
                                            <td width="40%">
                                                <img src="{{ asset('images/mails/persons/5.png')  }}" alt="" width="100%">
                                            </td>

                                            <td width="60%">
                                                <p style="color: #585f76; margin-bottom: 20px; margin-top: 20px;">
                                                    Для того, чтобы найти необходимую экскурсию, достаточно ввести город
                                                    на главной Excurseguide.ru и получить список экскурсий в данном городе!
                                                </p>

                                                <p style="color: #585f76; margin-bottom: 20px; margin-top: 20px;">
                                                    Контакты гидов находятся в открытом доступе, так что ты можешь связаться
                                                    с гидом, предлагающим понравившуюся тебе экскурсию любым удобным
                                                    способом, а также в мессенджере на нашем сайте!
                                                </p>

                                                <a href="https://excursguide.ru/" target="_blank"
                                                   style="line-height: 16px; display:inline-block; padding: 13px 22px; color: #ffffff; background-color: #405089; border-radius: 25px; font-size: 16px; text-decoration: none;">Перейти на сайт</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <div style="background-color: #cccccc; height: 1px; margin-top: 40px; margin-bottom: 40px;"></div>

                                    <p style="color: #585f76; margin-bottom: 20px; margin-top: 20px;">
                                        Заходи как можно чаще к нам для того, чтобы не пропустить сообщения в нашем мессенджере для общения с гидами.
                                        Это можно делать и с телефона, ведь наш сайт адаптирован под мобильную версию!
                                    </p>

                                    <p style="color: #585f76; margin-bottom: 20px; margin-top: 20px;">
                                        Для твоего удобства мы подготовили небольшую инструкцию по пользованию нашим сайтом.
                                        Это очень просто и удобно!
                                    </p>

                                    <a href="https://excursguide.ru/" target="_blank"
                                       style="line-height: 16px; display:inline-block; padding: 13px 22px; color: #ffffff; background-color: #405089; border-radius: 25px; font-size: 16px; text-decoration: none;">Посмотреть инструкцию</a>

                                    <div style="background-color: #cccccc; height: 1px; margin-top: 40px; margin-bottom: 40px;"></div>

                                    <h4>
                                        При выборе экскурсии:
                                    </h4>

                                    <ol style="margin-left: 15px;padding-left: 0;" start="4">
                                        <li style="color: #585f76; font-size: 14px; margin-bottom: 10px;">
                                            Внимательно ознакомься с перечнем экскурсий в городе, куда ты собираешься.
                                        </li>
                                        <li style="color: #585f76; font-size: 14px; margin-bottom: 10px;">
                                            Выбери 3-5 понравившиеся и подходящие по продолжительности и локации экскурсии
                                        </li>
                                        <li style="color: #585f76; font-size: 14px; margin-bottom: 10px;">
                                            Свяжись с гидами с помощью мессенджера на нашем сайте или любым другим удобным способом
                                        </li>
                                        <li style="color: #585f76; font-size: 14px; margin-bottom: 10px;">
                                            Пообщавшись с гидами, ты сразу поймешь, с кем из них вы на одной волне и кто сможет сопроводить в необходимую тебе дату!
                                        </li>
                                    </ol>

                                    <p style="color: #585f76; margin-bottom: 20px; margin-top: 20px;">
                                        Путешествовать с Excursguide стало легко и просто!
                                    </p>

                                    <p style="color: #585f76; margin-bottom: 20px;">
                                        ____<br/><br/>
                                        С уважением к тебе и твоим путешествиям,<br/>
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

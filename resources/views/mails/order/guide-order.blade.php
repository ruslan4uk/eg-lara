<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap&subset=cyrillic');
        html, body, * {
            font-family: 'Montserrat', sans-serif;
        }
        .background {
            background-image: url('{{ asset('images/mails/moderate-tour.png') }}');
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
                                    <h2 style="color: #405089; margin-bottom: 20px; font-weight: 500; font-size: 22px;">Здравствуйте, {{ $data->guide['name'] }}!</h2>

                                    <p style="color: #585f76; margin-bottom: 20px;">
                                        <strong>
                                            Экскурсию "{{ $data->tour->name }}" заказал турист
                                        </strong>
                                    </p>

                                    <div style="background-color: #cccccc; height: 1px; margin-top: 40px; margin-bottom: 40px;"></div>

                                    <p style="color: #585f76; margin-bottom: 20px;">
                                        <strong>Контактные данные туриста:</strong>
                                    </p>

                                    <p style="color: #585f76; margin-bottom: 20px;">
                                        <strong>Имя: </strong>{{ $data->name }}
                                    </p>

                                    <p style="color: #585f76; margin-bottom: 20px;">
                                        <strong>Email: </strong>{{ $data->email }}
                                    </p>

                                    <p style="color: #585f76; margin-bottom: 20px;">
                                        <strong>Колличество человек: </strong>{{ $data->people_count }}
                                    </p>

                                    <p style="color: #585f76; margin-bottom: 20px;">
                                        <strong>Телефон: </strong>{{ $data->phone }}
                                    </p>

                                    <p style="color: #585f76; margin-bottom: 20px;">
                                        <strong>Мессенджер для связи: </strong>{{ $data->messenger }}
                                    </p>

                                    <p style="color: #585f76; margin-bottom: 20px;">
                                        <strong>Дата: </strong>{{ \Carbon\Carbon::parse($data->date_start)->format('M d Y') }}
                                        @if($data->date_end)
                                            - {{ \Carbon\Carbon::parse($data->date_end)->format('M d Y') }}
                                        @endif
                                    </p>

                                    @if($data->comment)
                                        <p style="color: #585f76; margin-bottom: 20px;">
                                            <strong>Комментарий:</strong>
                                            <br/>
                                            {{ $data->comment }}
                                        </p>
                                    @endif

                                    <div style="background-color: #cccccc; height: 1px; margin-top: 40px; margin-bottom: 40px;"></div>

                                    <a href="https://excursguide.ru/order/{{$data->id}}/confirm?hash={{$data->hash}}" target="_blank"
                                       style="line-height: 16px; display:inline-block; padding: 13px 22px; color: #ffffff; background-color: #405089; border-radius: 25px; font-size: 16px; text-decoration: none;">Подтвердить заказ</a>

                                    <p style="color: #585f76; margin-bottom: 20px;">
                                        *Нажимая подтвердить заказ, турист получит уведомление на электронную почту
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

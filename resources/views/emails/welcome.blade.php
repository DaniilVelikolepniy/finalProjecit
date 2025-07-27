<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #e3f2fd;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .content {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #90caf9;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            padding: 10px;
            background-color: #e3f2fd;
            border-radius: 5px;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Добро пожаловать!</h1>
        <p>Спасибо за регистрацию в нашем сервисе.</p>
    </div>
    
    <div class="content">
        <h2>Здравствуйте, {{ $userName }}!</h2>
        <p>Мы рады видеть вас среди пользователей нашего сайта бронирования отелей.</p>
        <p>Теперь вы можете:</p>
        <ul>
            <li>Бронировать номера онлайн</li>
            <li>Управлять своими бронированиями</li>
            <li>Получать специальные предложения</li>
        </ul>
        <p>Если у вас возникнут вопросы, просто ответьте на это письмо или свяжитесь с нашей поддержкой.</p>
    </div>
    
    <div class="footer">
        <p>С уважением, команда Hotel Booking System</p>
    </div>
</body>
</html> 
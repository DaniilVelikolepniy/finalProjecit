<!-- resources/views/emails/booking_html.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Бронирование</title>
</head>
<body>
<h1>Бронирование подтверждено</h1>

<p>Ваш номер: <strong>{{ $booking->room_name }}</strong></p>
<p>Дата: {{ $booking->started_at->format('d.m.Y') }} — {{ $booking->finished_at->format('d.m.Y') }}</p>

<p>Спасибо за бронирование!</p>
</body>
</html>

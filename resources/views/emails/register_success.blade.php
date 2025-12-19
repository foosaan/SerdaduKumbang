<!-- Email template for successful registration -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Berhasil</title>
</head>
<body>
    <h2>Halo, {{ $name }}!</h2>

    <p>Terima kasih telah mendaftar. Berikut adalah detail akun Anda:</p>

    <ul>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>

    <p>Silakan login menggunakan email dan password di atas.</p>

    <p>Terima kasih,<br>{{ config('app.name') }}</p>
</body>
</html>
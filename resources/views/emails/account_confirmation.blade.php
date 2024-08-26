<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
<div style="font-family: Arial, sans-serif; margin: 20px;">
    <h2>Hello, {{ $userName }}!</h2>
    <p>Thank you for registering with us. To complete your registration, please verify your email address by clicking
        the link below:</p>
    <p>
        <a href="{{ $verificationUrl }}" style="color: #1a73e8; text-decoration: none;">
            Verify Your Email Address
        </a>
    </p>
    <p>If you have any questions, feel free to contact us.</p>
    <p>Best regards,<br>The {{ config('app.name') }} Team</p>
</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Subscription Reminder</title>
</head>
<body>
    <h1>Subscription Expiring Soon</h1>
    <p>Dear {{ $subscription->student->name }},</p>
    <p>Your subscription (ID: {{ $subscription->id }}) is set to expire on {{ $subscription->expires_at }}. Please renew it to continue accessing our services.</p>
    <p>Best regards,<br>Your Team</p>
</body>
</html>

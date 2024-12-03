<!DOCTYPE html>
<html>
<head>
    <title>Payment Successful</title>
</head>
<body>
    <?php
    ?>
    <h1>Hi, {{ $user->name }}!</h1>
    <p>Thank you for your payment. Your order #{{ $createdOrderId }} has been successfully placed.</p>
    <p>Order Details:</p>
    <ul>
        <li>Total Amount: 1000 LKR</li>
        <li>Payment Status: Paid</li>
    </ul>
    <p>We appreciate your business!</p>
</body>
</html>

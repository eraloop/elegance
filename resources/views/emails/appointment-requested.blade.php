<!DOCTYPE html>
<html>

<head>
    <title>New Appointment Request</title>
</head>

<body>
    <h1>New Appointment Request</h1>
    <p><strong>Service:</strong> {{ $data['service_name'] }}</p>
    <p><strong>Date:</strong> {{ $data['date'] }}</p>
    <p><strong>Time:</strong> {{ $data['time'] }}</p>
    <p><strong>Customer Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Customer Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Customer Phone:</strong> {{ $data['phone'] }}</p>
    @if(!empty($data['notes']))
        <p><strong>Notes:</strong> {{ $data['notes'] }}</p>
    @endif
</body>

</html>
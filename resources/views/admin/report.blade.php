<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Report Date : {{ date('d M Y h:i:s') }}
    <br><br>
    <table width="100%" border="1">
        <thead>
            <tr>
                <th>No.</th>
                <th>Booking Code</th>
                <th>Name</th>
                <th>Car</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td></td>
                    <td>{{ $item->order_code }}</td>
                    <td>{{ $item->User->name }}</td>
                    <td>{{ $item->Car->car_name }}</td>
                    <td>{{ $item->order_start }}</td>
                    <td>{{ $item->order_end }}</td>
                    <td>{{ $item->order_status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
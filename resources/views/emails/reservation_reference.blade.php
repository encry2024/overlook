<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        Hi <b>{{ $customer->full_name() }}</b>,
        <br><br>
        Here's your RESERVATION REFERENCE <b>{{ $reservation->reference_number }}</b>
        <br>
        Show it on the front desk to further process your reservation
        <br><br>
        Thank you.
        <br><br><br>
        Site: overlook-resort.com
        <br>
        E-mail: overlook-resort@yahoo.com
    </body>
</html>
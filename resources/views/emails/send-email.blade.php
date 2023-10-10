<!DOCTYPE html>
<html>
<head>
    <title>santrikoding.com</title>
</head>
<body>
    <h3>{{ $data['header'] }}</h3>
    <h4>{{ $data['name'] }}</h4>
    <h4>{{ $data['body'] }}</h4>
    <a href="{{URL::to('/')}}/confirmation-email/{{ $data['link'] }}">Konfirmasi Email</a>
    <p>Terimakasih</p>
</body>
</html>

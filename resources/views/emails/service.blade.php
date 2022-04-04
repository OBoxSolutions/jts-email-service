<!DOCTYPE html>
<html>
<body>
    <h1>Mail received via portfolio</h1>
    <br>
    <p>Name: <small>{{$data['name']}}</small></p>
    <p>Email: <small>{{$data['address']}}</small></p>
    <p>Message:</p>
    <br>
    <p>{{ $data['body'] }}</p>
</body>
</html>

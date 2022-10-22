<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
 <h1>Login With Facebook</h1>
<hr>
 <form action="{{ route('user_facebook') }}" method="post">
    @csrf
 <input type="submit" value="Login With Facebook"/>
 </form>
</body>
</html>
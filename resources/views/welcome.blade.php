<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="">
            @if (Route::has('Register'))
                <div class="">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="">Log in using Gmail</a>
                        <br/>
                        <a href="{{ route('Register') }}" class="">Register in using Gmail</a>
                    
                    @endauth
                </div>
            @endif
        </div>
</body>
</html>

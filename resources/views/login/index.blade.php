<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="stylesheet" href="./assets/css/color.css">
</head>
<body class="w-full grid place-items-center h-screen ">
    <div class="login-container rounded-md text-white p-10">
        <h1 class="text-2xl text-center">Welcome Back!</h1>
        <p class=" text-slate-500 text-center">We're so excited to see you again!</p>
        <form  action="authenticate" method="POST" class="pt-5 text-slate-300 text-sm">
            @csrf
            <label for="email">EMAIL OR PHONE NUMBER <b class="text-red-400">*</b></label><br>
            <input type="text" name="email" class="w-full" required autocomplete="off"><br><br>
            <label for="password">PASSWORD <b class="text-red-400">*</b></label><br>
            <input type="password" name="password" id="" class="w-full" autocomplete="off" required>
            <a href="#" class="text-blue-500">forgot your passowrd?</a>
            <br><input class="w-full bg-blue-600 mt-5 h-10 font-bold cursor-pointer" type="submit" value="LOGIN">
        </form>
        <p class="text-slate-500">need an account? <a href="register" class="text-blue-500">Register</a></p>
        
    </div>
</body>
</html>
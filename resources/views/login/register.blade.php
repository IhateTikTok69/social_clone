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
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
</head>
<body class="w-full grid place-items-center h-screen ">
        
    <div class="register-container rounded-md text-white p-10">
        <h1 class="text-2xl text-center">Create an account</h1>
        <form  action="POST" class="pt-5 text-slate-300 text-md">
            <label for="email">EMAIL<b class="text-red-400">*</b></label><br>
            <p id="emailValidationMessage" class=""></p>
            <input name="email" id="emailInput" type="text" class="w-full" required><br><br>
            <label for="displayName">DISPLAY NAME<b class="text-red-400">*</b></label><br>
            <input name="displayName" type="text" class="w-full" required><br><br>
            <label for="username">USERNAME<b class="text-red-400">*</b></label><br>
            <input name="username" type="text" class="w-full" required><br><br>
            <label for="password">PASSWORD <b class="text-red-400">*</b></label><br>
            <p id="passwordValidationMessage" class=""></p>
            <input type="password" name="" id="passwordInput" class="w-full"><br><br>
            <label for="dob">DATE OF BIRTH <b class="text-red-400">*</b></label><br>
            <p id="ageValidationMessage" class=""></p>
            <div class="flex">
                <select name="month" class="w-1/3 cursor-pointer" id="" required>
                    <option class="hidden" value="0">Month</option>
                    <option class="" value="1">january</option>
                    <option class="" value="2">February</option>
                    <option class="" value="3">March</option>
                    <option class="" value="4">April</option>
                    <option class="" value="5">May</option>
                    <option class="" value="6">June</option>
                    <option class="" value="7">July</option>
                    <option class="" value="8">August</option>
                    <option class="" value="9">September</option>
                    <option class="" value="10">October</option>
                    <option class="" value="11">November</option>
                    <option class="" value="12">December</option>
                </select>
                <select name="day" class="w-1/3" id="" required>
                    <option class="hidden cursor-pointer" value="0" >Day</option>
                    @for($i=1; $i<32; $i++)
                    <option class="text-right  hover:bg-slate-500" value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
                <input name="year" type="number" class="w-1/3 text-md placeholder:text-slate-300" placeholder="Year" required>
            </div>
            <input type="checkbox"
            class="before:content[''] peer relative h-5 w-5 border-none mt-5"
            id="blue" name="tos" id="tos" required>
            <label for="tos">by checking this box You agree to our <a href="" class="text-blue-600">Terms of Serveice</a> and <a href="" class="text-blue-600">Privacy Policy</a></label>
            <br><input class="w-full bg-blue-600 mt-5 h-10 font-bold cursor-pointer" type="submit" value="LOGIN">
        </form>
        <p class="text-slate-500"><a href="login" class="text-blue-500">Already have an account?</a></p>
        
    </div>
    <script src="./assets/js/login.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document | {{$directory}}</title>
    <link rel="stylesheet" href="/assets/css/friends.css">
    <link rel="stylesheet" href="/assets/css/chat.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/assets/css/color.css">
    @vite('resources/css/app.css')
</head>
<body>
    <div class="server-selector overflow-visible absolute pt-4 ">
        <div class="selection-group flex home">
            <div class="sideHoe w-1 h-10 bg-white mr-2 rounded-r-md mt-1"></div>
            <button href="home" class=" w-12 aspect-square channel-bg rounded-full server-selection p-2 hover:bg-blue-500 hover:rounded-2xl quick-transition">
                <img src="/assets/main-icon.png" class=" aspect-square" alt="">
            </button>
        </div>
        <div class="selection-group flex home">
            <div class="sideHoe w-1 h-10  mr-2 rounded-r-md mt-1"></div>
            <button href="home" class=" w-12 aspect-square channel-bg rounded-full server-selection p-2 hover:bg-blue-500 hover:rounded-2xl quick-transition">
                <img src="/assets/main-icon.png" class=" aspect-square" alt="">
                <i class="absolute -mt-2 text-xs bg-red-600 p-2 rounded-full py-0  text-white not-italic">1</i>
            </button>
        </div>
    </div>
    <div class="menu-text">
        <div class="navbar">
            <div class="p-2 channel-bg part-2">
                @yield('server-context')
            </div>
            <div class="burger-menu">
                <button><i class="bi bi-list text-4xl"></i></button>
            </div>
            <div class="p-2 pl-5 flex">
                @yield('context-menu')
            </div>
        </div>
        <div class="channel-selector w-60 overflow-visible absolute p-3 pt-2 menu-text">
            @yield('channel-select')
            <x-custom-context-menu/>
        </div>
        <div class="main-content expand">
            @yield('main-content')
        </div>
    </div>
    <script src="/assets/js/friends.js"></script>
    <div class="user-profile-area fixed w-60 p-3 pt-2">
        <img src="{{$user->profile_pic}}" alt=""> 
        <b class="text-white font-normal">{{$user->display_name}}</b>
        <a href="{{route('logout')}}" class="text-red-500 inline-block">LOG OUT</a>
    </div>
</body>
</html>
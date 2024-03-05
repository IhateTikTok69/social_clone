@extends('main.layout')
@section('server-context')
    <div class="rounded-sm desc h-7 w-full server-bg menu-text p-1 text-sm cursor-default"><span>Find or start a conversation</span></div>
@endsection
@section('context-menu')
 <x-friend-menu :directory=$directory/>
@endsection
@section('channel-select')
    <x-home-menu :selected=$selected/>
    <x-fetch-conversations :chats=$chats :userId=$userId/>
@endsection
@section('main-content')
    <div class="chat-area p-5 relative">
        <h1>PENDING - {{$count}}</h1><br>
        <div class="friend-list">
            @foreach ($outgoing as $out)
                <hr>
                <div id="{{$out->user_id}}" 
                    class="relative customContext flex w-full h-14 hover:selected-bg rounded-sm p-2 pl-3 hover:text-slate-100 mb-1">
                    <div class="mr-2 rounded-full">
                        <img class="aspect-square w-8 rounded-full object-scale-down" src="{{$out->profile_pic}}" alt="">
                    </div>
                    <span class="text-lg">{{$out->display_name}}</span> 
                    <span class="text-xs ml-2 absolute top-9 left-11">Outgoing friend request</span>
                    <a href="cancelreuest/{{$out->id}} " class="bi bi-x
                    cursor-pointer absolute 
                    right-5 text-4xl top-2.5 
                    hover:text-red-500
                    hover:bg-black
                    bg-gray-700 rounded-full"></a>
                </div>
                
            @endforeach
        </div>
        <div class="friend-list">
            @foreach ($incoming as $in)
                <hr>
                <div id="{{$in->user_id}}" 
                    class="relative customContext flex w-full h-14 hover:selected-bg rounded-sm p-2 pl-3 hover:text-slate-100 mb-1">
                    <div class="mr-2 rounded-full">
                        <img class="aspect-square w-8 rounded-full object-scale-down" src="{{$in->profile_pic}}" alt="">
                    </div>
                    <span class="text-lg">{{$in->display_name}}</span>
                    <span class="text-xs ml-2 absolute top-9 left-11">Incoming friend request</span>
                    <a href="acceptrequest/{{$in->id}}" class="bi bi-check 
                    cursor-pointer absolute 
                    right-20 text-4xl top-2.5 
                    hover:text-green-500
                    hover:bg-black
                    bg-gray-700 rounded-full"></a>
                    <a href="denyrequest/{{$in->id}}" class="bi bi-x 
                    cursor-pointer absolute 
                    right-5 text-4xl  top-2 
                    hover:text-red-500
                    hover:bg-black
                    bg-gray-700 rounded-full"></a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="profile-area">
    <h1>Active Now</h1>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        function findFriend(){
            $.ajax({
                url: "/findFriend",
                method: "POST",
                data: {
                    _token : '{{csrf_token()}}',
                    username : $('#search').val()
                },
                error: function (error) {
                    let fetchFriend = "<p class='text-red-500'> sorry we couldn't find a user with matching username </p>"
                    $('.friend-list').html(fetchFriend)
                },
            }).done(function (res){
                let fetchFriend = res.view;
                $('.friend-list').html(fetchFriend)
            })
        }
        $("#search").keyup(function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
            }
        });

        $("#form").submit(function(event) {
            event.preventDefault();
            findFriend()
        });
    });
</script>
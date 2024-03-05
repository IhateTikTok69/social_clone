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
        <b class="text-white text-lg">ADD FRIEND</b>
        <p class="mt-3">You can add friends with their username</p>
        <form class="mt-3 relative" id="form">
            <input id="search" required class="w-full h-12 rounded-md p-1 input-bg px-5" type="search" name="" id="" placeholder="You can add friends with their username">
            <button type="submit" class=" text-white absolute right-2 top-2 bg-blue-800 p-5 py-1">Find Friend</button>
        </form>
        <hr>
        <div class="friend-list">
            
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
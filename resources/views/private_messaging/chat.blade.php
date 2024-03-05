@extends('main.layout')
@section('server-context')
    <div class="rounded-sm desc h-7 w-full server-bg menu-text p-1 text-sm cursor-default "><span>Find or start a conversation</span></div>
@endsection
@section('context-menu')
    <img src="{{$friend->profile_pic}}" class="w-8 h-8 rounded-full mr-2" alt="">
    <b class="text-white font-semibold">{{$friend->display_name}}</b>
@endsection
@section('channel-select')
    <x-home-menu :selected=$selected/>
    <x-fetch-conversations :chats=$chats :userId=$userId/>
    <div class="conversations"></div>
@endsection
@section('main-content')
<div class="messages chat-area chat pt-6 ">
    <div class="message"></div>
    @foreach ($messages as $index => $message)
        @if ($index === 0 || $message->user_id !== $messages[$index - 1]->user_id)
        <div class="message customContext pl-5">
            <img src="{{ $message->profile_pic}}" alt="">
            <b class="text-white ml-3 text-md font-normal">{{ $message->display_name}}</b> 
            <i class="pl-2 text-xs not-italic">{{$message->created_at}}</i><br>
        @endif
        <p class="color-white ml-14 mt-1">{!!$message->content!!}</p><br>
        @if ($index === count($messages) - 1 || $message->user_id !== $messages[$index + 1]->user_id)
            </div>
        @endif
    @endforeach
    <x-input-area :emotes=$emotes/>
</div>
<div class="profile-area ">
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script 
src="https://cdnjs.cloudflare.com/ajax/libs/pusher/8.3.0/pusher.min.js" 
integrity="sha512-tXL5mrkSoP49uQf2jO0LbvzMyFgki//znmq0wYXGq94gVF6TU0QlrSbwGuPpKTeN1mIjReeqKZ4/NJPjHN1d2Q==" 
crossorigin="anonymous" 
referrerpolicy="no-referrer">
</script>
<script>
    $(document).ready(function() {
    const pusher  = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'ap1'});
    const activeConversation = pusher.subscribe('{{$convo->id}}');
    const notifIdReceiver = pusher.subscribe('{{$user->id}}');
    var currentSender 
    var chatArea = $('.chat-area');
    chatArea.scrollTop(chatArea.prop("scrollHeight"));
    notifIdReceiver.bind('notif', function(data){
        $.post("/getNotif",{
            _token:  '{{csrf_token()}}',
            senderId: data.senderId,
            senderPic: data.senderPic,
            senderName: data.senderName,
            activeConvo: '{{$userId}}',
        })
        .done(function (res) {
            const x = data.senderId;
            $('#'+x).remove()
            $('#outer'+x).remove()
            const putOnTop = res.onTop
            const putNotif = res.notif
            $(".conversations").first().before(putOnTop)
            $('.home').first().before(putNotif)
        })
    }) 
    
    activeConversation.bind('chat', function (data) {
        $.post("/receive", {
        _token:  '{{csrf_token()}}',
            message: data.message,
            sendDate: data.sendDate,
            senderPic: data.senderPic,
            senderName: data.senderName,
        })
        .done(function (res) {
            $(".messages > .message").last().after(res);
            chatArea.scrollTop(chatArea.prop("scrollHeight"));
        });
    });
        $("#message").keyup(function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
            }
        });

        $("#form").submit(function(event) {
            event.preventDefault();
            sendMessage();
        });

        function sendMessage() {
            $.ajax({
                url:     "/send",
                method:  'POST',
                headers: {
                    'X-Socket-Id': pusher.connection.socket_id
                },
                data:    {
                    _token:  '{{csrf_token()}}',
                    message: $("#message").val(),
                    convoId: '{{$convo->id}}',
                    senderId: '{{$user->id}}',
                    targetId: '{{$userId}}',
                    targetPic: '{{$friend->profile_pic}}',
                    targetName: '{{$friend->display_name}}'
                }
            }).done(function (res) {
                let viewHtml = res.view;
                let data = res.data;
                let a = res.a
                let x = data.targetId;
                $('#'+x).addClass('hidden')
                $(".messages > .message").last().after(viewHtml);
                chatArea.scrollTop(chatArea.prop("scrollHeight"));
                $(".conversations").first().before(a)
            });
            $("#message").val("");
        }
        $('#displayEmotes').click(function (e) { 
            e.preventDefault();
            const emoteArea = $('.emote-area')
            if(emoteArea.hasClass('hidden')){
                emoteArea.removeClass('hidden')
            }else{
                emoteArea.addClass('hidden')
            }
        });
    });
</script>
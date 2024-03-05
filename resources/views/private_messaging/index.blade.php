<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/style.css">
    <title>Document</title>
</head>
<body>
    <div class="chat">
        {{$convo->id}}
        <div class="top"></div>
        <div class="messages">
            <p class="message"></p>
            @foreach ($messages as $index => $message)
           
              
        </div>

    </div>
</body>
<script>
    const pusher  = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'ap1'});
    const channel = pusher.subscribe('{{$convo->id}}');
    var currentSender 
    channel.bind('chat', function (data) {
        $.post("/receive", {
        _token:  '{{csrf_token()}}',
            message: data.message,
            senderId: data.senderId,
        })
        .done(function (res) {
        $(".messages > .message").last().after(res);
        $(document).scrollTop($(document).height());
        });
    });

    //Broadcast messages
    $("#form").submit(function (event) {
        event.preventDefault();

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
            senderId: '{{$user->id}}'
        }
        }).done(function (res) {
        $(".messages > .message").last().after(res);
        $(document).scrollTop($(document).height());
        });
    });
</script>
</html>
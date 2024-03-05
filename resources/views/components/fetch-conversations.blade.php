@foreach ($chats as $chat)
<a id="{{$chat->user_id}}" href="/h/chat/{{$chat->user_id}}" 
    class="conversations flex mb-1 customContext w-full h-fit 
    {{($chat->user_id == $userId) ?'selected-bg text-slate-100':''}}
    hover:selected-bg rounded-sm p-2 pl-3 hover:text-slate-100 cursor-pointer">
    <div class="mr-2 rounded-full">
        <img class="w-8 h-8 rounded-full bg-black" src="{{$chat->profile_pic}}" alt="">
    </div> 
    <span class="mt-1 cursor-pointer">{{$chat->display_name}}</span>
</a>
@endforeach
<a id="{{$senderId}}" href="/h/chat/{{$senderId}}" 
    class="flex mb-1 conversations customContext w-full h-fit
    {{($senderId == $activeConvo) ? 'selected-bg text-slate-100':''}}  
    hover:selected-bg rounded-sm p-2 pl-3
    hover:text-slate-100 cursor-pointer">
    <div class="mr-2 rounded-full">
        <img class="w-8 h-8 rounded-full bg-black" src="{{$senderPic}}" alt="">
    </div>
    <span class="mt-1 cursor-pointer">{{$senderName}}</span>
</a>
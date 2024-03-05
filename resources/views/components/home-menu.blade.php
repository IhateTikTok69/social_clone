<a href="/h/@me" class="flex w-full h-fit {{$selected == 'home' ? 'selected-bg text-slate-100' : ''}} hover:selected-bg rounded-sm p-2 pl-3 hover:text-slate-100">
    <div class="aspect-square w-5 h-5 mr-5 rounded-full">
        <i class="bi bi-people-fill text-2xl"></i>
    </div>
    <span class="mt-1">Friends</span>
</a>
<a href="/h/emotes" class="flex w-full h-fit hover:selected-bg rounded-sm p-2 pl-3 hover:text-slate-100 {{$selected == 'emotes' ? 'selected-bg text-slate-100' : ''}}">
    <div class="aspect-square w-5 h-5 mr-5 mt-0.5 rounded-full {{$selected == 'emotes' ? 'text-yellow-400' : ''}} hover:text-yellow-400">
        <i class="bi bi-emoji-smile-fill text-2xl"></i>
    </div>
    <span class="mt-1">Emotes</span>
</a>
<br>
<b class="text-xs mb-5 cursor-pointer hover:text-slate-100">DIRECT MESSAGES</b><br>
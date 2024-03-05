<div class="bottom">
    <form id="form">
        <input id="message" class="w-full chat-input color-white" type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
    </form>
    <button id="displayEmotes" class="absolute top-2 right-8 text-2xl hover:text-yellow-400"><i class=" bi bi-emoji-smile-fill"></i></button>
    <div class="emote-area hidden">
        <button class="m-4 px-3 selected-bg text-white font-semibold rounded-sm">Emoji</button>
        <div class="grid w-full grid-cols-10 gap-0 h-4/5">
            <div class="server-bg p-2"><i class=" bi bi-emoji-smile-fill text-3xl"></i></div>
            <div class="col-span-9 border border-black p-2">
                <p class="text-xs cursor-pointer text-white">GLOBAL EMOTES</p>
                @foreach ($emotes as $emote)
                <button value='{{$emote->name}}' id="addToText" class="h-12 w-12 hover:selected-bg p-1.5 rounded-md"><img src="{{$emote->path}}"  alt=""></button>
                @endforeach
            </div>
        </div>
    </div>
</div>
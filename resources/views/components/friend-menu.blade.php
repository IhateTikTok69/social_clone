<div class="w-28 border-r border-slate-600">
    <span class="flex w-full h-fit rounded-sm text-slate-100 cursor-default">
        <i class="menu-text bi bi-people-fill text-2xl mt-1 mr-2"></i> <b class="mt-1 font-semibold hides">Emotes</b>
    </span>
</div>
<div class="button-list menu-text font-semibold h-10 overflow-auto">
    <button>All</button>
    <a href="{{route('pendingFriends')}}" class="p-1 px-3 {{$directory === 'pending' ? 'selected-bg text-white':''}}">Pending</a>
    <button>Blocked</button>
    <a href="{{route('add_friend')}}" class="{{$directory === 'add' ? 'success-text':'add-friend'}} cursor-pointer">Add Friend</a>
</div>
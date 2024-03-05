<div class="relative customContext flex w-full h-14 hover:selected-bg rounded-sm p-2 pl-3 hover:text-slate-100">
    <div class="mr-2 rounded-full">
        <img class="aspect-square w-8 rounded-full object-scale-down" src="{{$pic}}" alt="">
    </div>
    <span class="">{{$name}}</span>
    <a href="sendRequest/{{$id}}" class="bi bi-plus 
    cursor-pointer absolute 
    right-5 text-4xl top-2 
    hover:text-green-500 bg-black rounded-full"></a>
</div>
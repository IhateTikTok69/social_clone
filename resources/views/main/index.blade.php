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
    <div class="chat-area p-5">
        <input type="search" name="" id="">
        <div class="friend-list">
            <h1>ONLINE - </h1><br>
            <hr class="horline mb-1">
            <button class="customContext flex w-full h-fit hover:selected-bg rounded-sm p-2 pl-3 hover:text-slate-100">
                <div class="mr-2 rounded-full">
                    <img class="aspect-square w-8 rounded-full" src="/assets/usr/rick.webp" alt="">
                </div>
                <span class="mt-1">Friends</span>
            </button>
        </div>
    </div>
    <div class="profile-area">
    <h1>Active Now</h1>
    </div>
@endsection
<script></script>
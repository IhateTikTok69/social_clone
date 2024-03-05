@extends('main.layout')
@section('server-context')
    <div class="rounded-sm desc h-7 w-full server-bg menu-text p-1 text-sm cursor-default"><span>Find or start a conversation</span></div>
@endsection
@section('context-menu')
<x-emote-navbar :directory=$directory/>
@endsection
@section('channel-select')
    <x-home-menu :selected=$selected/>
    <x-fetch-conversations :chats=$chats :userId=$userId/>
@endsection
@section('main-content')
    <div class="chat-area p-5">
        <div class="friend-list">
            <h1 class="text-sm">AVAILABLE EMOTES </h1>
            <hr class="horline mb-1">
        </div>
    </div>
    <div class="profile-area">
    <h1>Active Now</h1>
    </div>
@endsection
<script></script>
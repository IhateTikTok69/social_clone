<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use App\Events\pushNotif;
use App\Models\private_messages;
use App\Http\Requests\Storeprivate_messagesRequest;
use App\Http\Requests\Updateprivate_messagesRequest;
use App\Models\users;
use App\Models\have_chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\conversations;
use Illuminate\Support\Carbon;
use App\Models\emotes;

class PrivateMessagesController extends Controller
{
    public static function getEmotes()
    {
        $emotes = emotes::where('visibility', 'public')->get();
        return $emotes;
    }
    public function createConversation($id)
    {
        $id = $id;
        $user = Auth::guard('web')->user();
        DB::table('have_chats')
            ->updateOrInsert(
                ['user_1' => $user->id, 'user_2' => $id],
                ['updated_at' => now()]
            );
        DB::table('have_chats')
            ->updateOrInsert(
                ['user_1' => $id, 'user_2' => $user->id],
                ['updated_at' => now()]
            );
        return redirect()->route('direct_message', ['userId' => $id]);
    }

    function getConversationMessages($convo)
    {
        $messages = DB::table('private_messages')
            ->join('users', 'users.id', '=', 'private_messages.user_id')
            ->where('private_messages.convo_id', $convo->id)
            ->orderBy('private_messages.id', 'ASC')
            ->select('private_messages.*', 'users.display_name', 'users.profile_pic')
            ->get()
            ->map(function ($message) {
                $message->created_at = Carbon::parse($message->created_at)->format('m/d/Y h:i A');
                return $message;
            });
        return $messages;
    }
    function getCacheConversations($convo)
    {
        $chatKey =  'chat_version_' . $convo->id;
        $cachedChatVersion = Cache::get($chatKey);
        if (!$cachedChatVersion) {
            $cachedChatVersion = conversations::where('id', $convo->id)->value('chat_version');
        }
        return $cachedChatVersion;
    }
    public static function getAllChat($user)
    {
        $chats = have_chat::select('have_chats.*', 'users.id as user_id', 'users.display_name', 'users.userName', 'users.profile_pic', 'users.banner_pic')
            ->join('users', 'users.id', '=', 'have_chats.user_2')
            ->where('have_chats.user_1', $user->id)
            ->orderBy('have_chats.updated_at', 'DESC')
            ->get();
        return $chats;
    }
    public function index($userId)
    {
        $user = Auth::guard('web')->user();
        $emotes = $this->getEmotes();
        $chats = $this->getAllChat($user);
        $fetchAllConvo = conversations::where('user_1', $user->id)->orWhere('user_2', $user->id)->get();
        $userExist = users::all()->where('id', $userId)->first();
        if ($user->id == $userId or !$userExist) {
            return redirect()->route('newHomePage');
        } else {
            $friend = DB::table('users')->where('id', $userId)->first();
            $convo = conversations::where(function ($query) use ($userId, $user) {
                $query->where('user_1', $user->id)
                    ->where('user_2', $userId);
            })->orWhere(function ($query) use ($userId, $user) {
                $query->where('user_1', $userId)
                    ->where('user_2', $user->id);
            })->first();
            if (!$convo) {
                $convo = new conversations();
                $convo->user_1 = $user->id;
                $convo->user_2 = $userId;
                $convo->chat_version = '0';
                $convo->save();
            }
            $messages = $this->getConversationMessages($convo);
            foreach ($messages as $message) {
                foreach ($emotes as $emote) {
                    $message->content = str_replace($emote->name, " <img src='$emote->path' class='w-7 h-7 mx-1'>", $message->content);
                }
            }
            $directory = 'chat';
            $selected = '';
            return view('private_messaging/chat', compact('fetchAllConvo', 'convo', 'messages', 'user', 'directory', 'friend', 'chats', 'userId', 'selected', 'emotes'));
        }
    }
    public function send(Request $request)
    {
        $emotes = $this->getEmotes();
        $senderId = $request->senderId;
        $targetId = $request->targetId;
        $convoId = $request->convoId;
        $realMessage = $request->message;
        $message = $request->message;
        foreach ($emotes as $emote) {
            $message = str_replace($emote->name, "<img src='$emote->path' class='w-7 h-7 mx-1'>", $message);
        }
        $sendDate =  Carbon::parse(now())->format('m/d/Y h:i A');
        $senderData = users::select('profile_pic', 'display_name')->where('id', '=', $senderId)->first();
        $senderName = $senderData->display_name;
        $senderPic = $senderData->profile_pic;
        private_messages::create([
            'convo_id' => $convoId,
            'user_id' => $senderId,
            'content' => $realMessage,
            'edited' => '0'
        ]);
        conversations::where('id', $convoId)->increment('chat_version', 1);
        DB::table('have_chats')
            ->updateOrInsert(
                ['user_1' => $senderId, 'user_2' => $targetId],
                ['updated_at' => now()]
            );
        DB::table('have_chats')
            ->updateOrInsert(
                ['user_1' => $targetId, 'user_2' => $senderId],
                ['updated_at' => now()]
            );
        broadcast(new pushNotif($senderId, $senderName, $senderPic, $convoId, $targetId))->toOthers();
        broadcast(new PusherBroadcast($message, $convoId, $senderName, $senderPic, $sendDate, $senderId))->toOthers();
        $data = [
            'message' => $message,
            'senderPic' => $senderPic,
            'sendDate' => $sendDate,
            'senderName' => $senderName,
            'targetId' => $request->targetId,
            'targetPic' => $request->targetPic,
            'targetName' => $request->targetName,
        ];
        return response()->json(
            [
                'view' => view('private_messaging.send', $data)->render(),
                'a' => view('private_messaging.sendontop', $data)->render(),
                'data' => $data
            ]
        );
    }
    public function receive(Request $request)
    {
        $emotes = $this->getEmotes();
        $sendDate = $request->sendDate;
        $message = $request->message;
        foreach ($emotes as $emote) {
            $message = str_replace($emote->name, "<img src='$emote->path' class='w-7 h-7 mx-1'>", $message);
        }
        $senderPic = $request->senderPic;
        $senderName = $request->senderName;
        return view(
            'private_messaging/get',
            [
                'message' => $message,
                'senderPic' => $senderPic,
                'senderName' => $senderName,
                'sendDate' =>  $sendDate,
            ]

        );
    }
    public function getNotif(Request $request)
    {
        $senderId = $request->senderId;
        $senderPic = $request->senderPic;
        $senderName = $request->senderName;
        $activeConvo = $request->activeConvo;
        $data = [
            'senderId' => $senderId,
            'senderPic' => $senderPic,
            'senderName' => $senderName,
            'activeConvo' => $activeConvo,
        ];
        return response()->json(
            [
                'notif' => view('notif', $data)->render(),
                'onTop' => view('private_messaging.ontop', $data)->render(),
                'data' => $data,
            ]

        );
    }
}

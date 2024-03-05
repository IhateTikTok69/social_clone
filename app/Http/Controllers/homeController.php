<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\have_chat;
use App\Models\relationships;
use App\Models\users;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;


class homeController extends Controller
{
    public function getSpecifiedRelation($id)
    {
        $relation = DB::table('relationships')
            ->where('id', $id)
            ->first();
        return $relation;
    }

    public function getUser()
    {
        $user = Auth::guard('web')->user();
        return $user;
    }
    public function index()
    {
        $user = $this->getUser();
        $chats = PrivateMessagesController::getAllChat($user);
        $directory = 'Friends';
        $selected = 'home';
        $userId = 0; //set to 0 bcs I am LAZY! DO NOT CHANGE!
        return view('main/index', compact('directory', 'selected', 'user', 'chats', 'userId'));
    }
    public function emotesPage()
    {
        $user = $this->getUser();
        $chats = PrivateMessagesController::getAllChat($user);
        $directory = 'Emotes';
        $selected = 'emotes';
        $emotes = PrivateMessagesController::getEmotes();
        $userId = 0; //set to 0 bcs I am LAZY! DO NOT CHANGE!
        return view('main/emote-page', compact('directory', 'selected', 'user', 'chats', 'userId'));
    }
    public function pending()
    {
        $user = $this->getUser();
        $chats = PrivateMessagesController::getAllChat($user);
        $directory = 'pending';
        $selected = 'home';
        $outgoing = $this->getOutgoingRequest($user);
        $count = $this->countPendingRequests($user);
        $incoming = $this->getIncomingRequest($user);
        $userId = 0; //set to 0 bcs I am LAZY! DO NOT CHANGE!
        return view('main/pending', compact('incoming', 'directory', 'selected', 'user', 'chats', 'userId', 'outgoing', 'count'));
    }
    public function addFriend()
    {
        $user = $this->getUser();
        $chats = PrivateMessagesController::getAllChat($user);
        $directory = 'add';
        $selected = 'home';
        $userId = 0; //set to 0 bcs I am LAZY! DO NOT CHANGE!
        return view('main/addFriend', compact('directory', 'selected', 'user', 'chats', 'userId'));
    }
    public function findFriend(Request $request)
    {
        $user = $this->getUser();
        $targetUser = $request->username;

        $fetchFriend = users::where('userName', $targetUser)->first();
        $data = [
            'id' => $fetchFriend->id,
            'name' => $fetchFriend->display_name,
            'pic' => $fetchFriend->profile_pic,
        ];
        $relationExist = $this->getRelation($user, $fetchFriend->id);
        if ($user->id == $fetchFriend->id) {
            return 0;
        } elseif ($relationExist) {
            $status = $relationExist->status;
            return response()->json(
                [
                    'view' => view('main.friend-not-found', compact('status'))->render(),
                ]
            );
        } else {
            return response()->json(
                [
                    'view' => view('main.fetchFriend', $data)->render(),
                ]
            );
        }
    }

    public function getRelation($user, $id)
    {
        $relationExist = DB::table('relationships')->where(function ($query) use ($user, $id) {
            $query->where('relatingUser', $user->id)
                ->where('relatedUser', $id);
        })->first();
        return $relationExist;
    }
    public function sendFriendRequest($id)
    {
        $user = $this->getUser();
        $userExist = users::all()->where('id', $id)->first();
        $check = $this->getRelation($user, $id);
        if (!$userExist) {
            return redirect()->route('newHomePage');
        } else {
            if (!$check) {
                relationships::create([
                    'relatingUser' => $user->id,
                    'relatedUser' => $id,
                    'status' => 'pending',
                ]);
                return redirect()->route('pendingFriends');
            }
            return redirect()->route('pendingFriends');
        }
    }
    public function getIncomingRequest($user)
    {
        $incoming = DB::table('relationships')
            ->select('users.id AS user_id', 'users.display_name', 'users.userName', 'users.profile_pic', 'relationships.id', 'relationships.created_at')
            ->join('users', 'users.id', 'relationships.relatingUser')
            ->where(function ($query) use ($user) {
                $query->where('relatedUser', $user->id)
                    ->where('relationships.status', 'pending');
            })
            ->orderBy('relationships.created_at')
            ->groupBy('users.id', 'users.display_name', 'users.userName', 'users.profile_pic', 'relationships.id', 'relationships.created_at')
            ->get();
        return $incoming;
    }
    public function getOutgoingRequest($user)
    {
        $outgoing = DB::table('relationships')
            ->select('users.id AS user_id', 'users.display_name', 'users.userName', 'users.profile_pic', 'relationships.id', 'relationships.created_at')
            ->join('users', 'users.id', 'relationships.relatedUser')
            ->where(function ($query) use ($user) {
                $query->where('relatingUser', $user->id)
                    ->where('relationships.status', 'pending');
            })
            ->orderBy('relationships.created_at')
            ->groupBy('users.id', 'users.display_name', 'users.userName', 'users.profile_pic', 'relationships.id', 'relationships.created_at')
            ->get();
        return $outgoing;
    }
    public function countPendingRequests($user)
    {
        $getData = relationships::where(function ($query) use ($user) {
            $query->where('relatingUser', $user->id)
                ->where('status', 'pending');
        })->orWhere(function ($query) use ($user) {
            $query->where('relatedUser', $user->id)
                ->where('status', 'pending');
        })->get();
        $count = count($getData);
        return $count;
    }

    public function acceptFriendRequest($id)
    {
        $relation = $this->getSpecifiedRelation($id);
        relationships::where('id', $id)->update(['status' => 'friends']);
        relationships::create([
            'relatingUser' => $relation->relatedUser,
            'relatedUser' => $relation->relatedUser,
            'status' => 'friends',
        ]);
        return redirect()->route('pendingFriends');
    }
    public function cancelFriendRequest($id)
    {
        relationships::where('id', $id)->delete();
        return redirect()->route('pendingFriends');
    }
    public function denyFriendRequest($id)
    {
        relationships::where('id', $id)->delete();
        return redirect()->route('pendingFriends');
    }
}

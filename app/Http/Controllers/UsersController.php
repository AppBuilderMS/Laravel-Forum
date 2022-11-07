<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function notifications ()
    {

        //make all as read
        auth()->user()->unreadNotifications->markAsRead();

        //dd(auth()->user()->notifications->first()->data['discussion']['slug']); test to fitch notification data we need to call in the blade file

        //display all notifications
        $channels = Channel::all();
        return view('users.notifications', [
            'notifications' => auth()->user()->notifications()->paginate(5)
        ]);
    }
}

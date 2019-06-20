<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Admin;
use App\Events\MessageSent;
use App\Events\PrivateMessageSent;

class AdminMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function adminindex()
    {
        return view('Messenger.admin_index');
    }

    //FOR GROUP CHAT
    public function fetchMessages()
    {
        //return Message::with('user')->all();
        $allMessage = Message::all();
        return $allMessage->load('user','admin');
    }
    public function sendMessages(Request $request)
    {
        if($request->has('file'))
        {
            $filename = request('file')->store('group_chat');

            $message = Message::create([
                'user_id' => $request->user()->id,
                'image' => $filename,
                'receiver_id' => $request->receiver_id,
            ]);
        }
        else
        {
            $message = Auth::guard('admin')->user()->messages()->create(['message'=>$request->message]);
        }

        // broadcast(new MessageSent(auth()->user(),$message->load('user')))->toOthers();
        //  // broadcast(new MessageSent(auth()->user(),$request->message))->toOthers();

        // return response(['status'=>'Message sent successfully']);
    }
     //FOR PRIVATE CHAT
    public function fetchPrivateMessages($friendId)
    {
        $privateCommunication = Message::with('user')
                                ->where(['user_id' => auth()->id() , 'receiver_id' => $friendId])
                                //->orWhere(['user_id' => $friendId , 'receiver_id' => auth()->id()])
                                ->orWhere(function($query) use($friendId){
                                     $query->where(['user_id' => $friendId, 'receiver_id' => auth()->id()]);
                                })
                                ->get();
       
        
        return $privateCommunication;
    }
    public function sendPrivateMessages(Request $request,$friendId)
    {
        if($request->has('file'))
        {
            $filename = request('file')->store('private_chat');

            $message = Message::create([
                'user_id' => $request->user()->id,
                'image' => $filename,
                'receiver_id' => $friendId,
            ]);
        }
        else
        {
            $input = $request->all();
            $input['receiver_id'] = $friendId;
            $message = auth()->user()->messages()->create($input);
        }

        broadcast(new PrivateMessageSent($message->load('user')))->toOthers();

        return response(['status'=>'Private Message sent successfully']);
    }

    
}

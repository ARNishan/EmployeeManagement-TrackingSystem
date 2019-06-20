<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Admin;
use App\Events\MessageSent;
use App\Events\PrivateMessageSent;
use DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // { 
    //    $this->middleware('auth');
    // }
    public function __construct()
    {   
       //  if(Auth::guard('admin')->check()){
       //      $this->middleware('auth:admin');
       // }else{
       //     $this->middleware('auth');
       // }
        // $this->middleware('auth:admin')->only('adminindex','sendMessages','fetchMessages');
        $this->middleware('auth')->only('index','sendMessages','fetchMessages');
    }
    
    public function index()
    {  
        return view('Messenger.user_index');
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
   
        if(Auth::guard('admin')->check()){

       $message = Auth::guard('admin')->user()->messages()->create(['message'=>$request->message]);
            // $message_id = Auth::guard('admin')->user()->id;

       $MessageSent = new MessageSent();
       broadcast($MessageSent->Admin(Auth::guard('admin')->user(),$message->load('admin')))->toOthers();
       return response(['status'=>'Message sent successfully']);

       }else{
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
                        $message = auth()->user()->messages()->create(['message'=>$request->message]);
                    }
                    // $MessageSent = new MessageSent();
            
                    // broadcast($MessageSent->User(auth()->user(),$message->load('user')))->toOthers();
                    // $var = auth()->user();
                    //  broadcast(new MessageSent($var,$request->message))->toOthers();
            
                    // return response(['status'=>'Message sent successfully']);
            }
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

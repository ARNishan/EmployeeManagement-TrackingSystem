@extends('layouts.user_message_app')

@section('content')
       {{-- :user="{{auth()->user()}}" --}}
        <Chat
         {{-- @if(Auth::guard('admin')->check())
         :user="{{Auth::guard('admin')->user()}}"
         @elseif(Auth::guard('web')->check()) --}} 
         :user="{{auth()->user()}}"
         {{-- @endif --}}></Chat> 
@endsection

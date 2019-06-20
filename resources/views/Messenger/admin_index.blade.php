@extends('layouts.admin_message_app')

@section('content')
       {{-- :user="{{auth()->user()}}" --}}
        <Chat1 :user="{{Auth::guard('admin')->user()}}"></Chat1>
@endsection

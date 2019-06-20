<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});Broadcast::channel('lChat-{id}', function ($user, $id) {
    return true;
});
// Broadcast::channel('App.Admin.{id}', function ($admin, $id) {
//     return (int) $admin->id === (int) $id;
// }, ['guard' => 'admin']);
// Broadcast::channel('lChat', function ($user) {
//     // if(Auth::guard('admin')->check()){
//     // 	return Auth::guard('admin')->check();
//     // }
//     // else{
//     return true;
//   // }
// });
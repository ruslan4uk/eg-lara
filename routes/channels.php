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

Broadcast::routes( ["prefix" => "api", 'middleware' => ['api', 'jwt.auth'] ] );

Broadcast::channel('messenger.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('messenger-dialog.{dialog_uid}', function ($user, $dialog_uid) {
//    dd($user->userDialogs());
    return $user->userDialogs->contains('uid', '=', $dialog_uid);
});

<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\Artisan;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->forceDelete();
        Artisan::call('cache:clear');
    }
}

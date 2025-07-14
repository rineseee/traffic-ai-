<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /**
     * Fushat që mund të caktohen me mass assignment
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Merr të gjitha postimet e përdoruesit
     */
    /**admini */
    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = true;
        $user->save();

        return redirect()->back()->with('success', 'User is now admin!');
    }
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}

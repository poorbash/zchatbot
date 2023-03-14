<?php

namespace poorbash\ZChatBot\App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    protected $fillable = [
        'user_id',
        'username',
        'first_name',
        'last_name',
    ];

    protected $attributes = [
        'username' => null,
        'first_name' => null,
        'last_name' => null,
    ];

    public function isAdmin(): bool
    {
        return $this->user_id === config('bot.admin_id');
    }
}
<?php

namespace App\Models;

use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['sender_id', 'receiver_id', 'is_deleted'];


    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }


    public function getReceiverUser()
    {
        if(auth()->user()->id === $this->sender_id)
            return User::find($this->receiver_id);

        else
            return User::find($this->sender_id);
    }

}

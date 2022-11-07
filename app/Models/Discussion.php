<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\ReplyMarkedAsBestReply;

class Discussion extends Model
{
    use HasFactory;

    protected $guarded = [];
        //make relation using author as aname of relation instead of user so we need to use user_id as aforign key as second parameter im the relation
        public function author()
        {
            return $this->belongsTo(User::class, 'user_id');
        }

        //method used to overide what laravel using in routebinding instead of using the id (in show method in discussionController) to fetch the discussion from database
        public function getRouteKeyName()
        {
            return 'slug';
        }

        public function replies()
        {
            return $this->hasMany(Reply::class);
        }

        public function markAsBestReply(Reply $reply)
        {
            $this->update([
                'reply_id' => $reply->id
            ]);

            //to prevent the author of discussion from marking his reply as best reply
            if($reply->owner->id == $this->author->id)
            {
                return;
            }

            //to notify the owner of reply that his reply marked as best reply
            $reply->owner->notify(new ReplyMarkedAsBestReply($reply->discussion));
        }

        public function bestReply()
        {
            return $this->belongsTo(Reply::class, 'reply_id');
        }

        public function scopeFilterByChannels($builder)
        {
            if(request()->query('channel'))
            {
                //filter
                $channel = Channel::where('slug', request()->query('channel'))->first();

                if($channel)
                {
                    return $builder->where('channel_id', $channel->id);
                }

                return $builder;
            }
        }
}

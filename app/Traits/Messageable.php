<?php namespace app\Traits;


trait Messageable
{

    /**
     * Message relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('app\Models\Message');
    }

    /**
     * Thread relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function threads()
    {
        return $this->belongsToMany('app\Models\Thread', 'participants');
    }

    /**
     * Returns the new messages count for user
     *
     * @return int
     */
    public function newMessagesCount()
    {
        return count($this->threadsWithNewMessages());
    }

    /**
     * Returns all threads with new messages
     *
     * @return array
     */
    public function threadsWithNewMessages()
    {
        $threadsWithNewMessages = [];
        $participants = Participant::where('user_id', $this->id)->lists('last_read', 'thread_id');

        if ($participants) {
            $threads = Thread::whereIn('id', array_keys($participants))->get();

            foreach ($threads as $thread) {
                if ($thread->updated_at > $participants[$thread->id]) {
                    $threadsWithNewMessages[] = $thread->id;
                }
            }
        }

        return $threadsWithNewMessages;
    }

}
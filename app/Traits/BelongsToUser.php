<?php namespace app\Traits;


/**
 * Trait BelongsToUserTrait
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package App
 */
trait BelongsToUser
{

    /**
     * Get the user relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('auth.model'));
    }

}
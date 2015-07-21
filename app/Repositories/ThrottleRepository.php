<?php namespace App\Repositories;

use App\Throttle;

/**
 * Class ThrottleRepository
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package App\Repositories
 */
class ThrottleRepository
{


    /**
     * The user provider used for finding users
     * to attach throttles to.
     *
     * @var UserRepository
     */
    protected $userProvider;

    /**
     * Throttling status.
     *
     * @var bool
     */
    protected $enabled = true;

    /**
     * Creates a new throttle provider.
     *
     * @param Throttle $throttle
     * @param UserRepository $userProvider
     */
    public function __construct(
        Throttle $throttle,
        UserRepository $userProvider)
    {
        $this->model = $throttle;
        $this->userProvider = $userProvider;
    }

    /**
     * Finds a throttler by the given Model.
     *
     * @param \App\Models\User $user
     * @param string $ipAddress
     *
     * @return \App\Models\Throttle
     */
    public function findByUser($user, $ipAddress = null)
    {
        $model = $this->model;
        $query = $model->query()->where('user_id', '=', ($userId = $user->getId()));

        if ($ipAddress) {
            $query->where(function ($query) use ($ipAddress) {
                $query->where('ip_address', '=', $ipAddress);
                $query->orWhere('ip_address', '=', null);
            });
        }

        if (!$throttle = $query->first()) {
            $throttle = $this->model;
            $throttle->user_id = $userId;
            if ($ipAddress) {
                $throttle->ip_address = $ipAddress;
            }
            $throttle->save();
        }

        return $throttle;
    }

    /**
     * Finds a throttler by the given user ID.
     *
     * @param mixed $id
     * @param string $ipAddress
     *
     * @return \App\Contracts\Throttle\ThrottleInterface
     */
    public function findByUserId($id, $ipAddress = null)
    {
        return $this->findByUser($this->userProvider->findById($id), $ipAddress);
    }

    /**
     * Finds a throttling interface by the given user login.
     *
     * @param string $login
     * @param string $ipAddress
     *
     * @return \App\Contracts\Throttle\ThrottleInterface
     */
    public function findByUserLogin($login, $ipAddress = null)
    {
        return $this->findByUser($this->userProvider->findByLogin($login), $ipAddress);
    }

    /**
     * Enable throttling.
     *
     * @return void
     */
    public function enable()
    {
        $this->enabled = true;
    }

    /**
     * Disable throttling.
     *
     * @return void
     */
    public function disable()
    {
        $this->enabled = false;
    }

    /**
     * Check if throttling is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

}
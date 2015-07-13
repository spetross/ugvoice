<?php namespace app\Support;

use Redirect;
use Request;

/**
 * Backend Helper
 *
 * @package app\Support
 * @author Petross Simon
 */
class BackendHelper
{
    /**
     * Returns the backend URI segment.
     */
    public function uri()
    {
        return config('backend.uri', 'backend');
    }

    /**
     * Returns a URL in context of the Backend
     * @param null $path
     * @param array $parameters
     * @param null $secure
     * @return string
     */
    public function url($path = null, $parameters = [], $secure = null)
    {
        return url($this->uri() . '/' . $path, $parameters, $secure);
    }

    /**
     * Returns the base backend URL
     * @param null $path
     * @return string
     */
    public function baseUrl($path = null)
    {
        $backendUri = $this->uri();
        $baseUrl = Request::getBaseUrl();

        if ($path === null) {
            return $baseUrl . '/' . $backendUri;
        }

        //$path = RouterHelper::normalizeUrl($path);
        return $baseUrl . '/' . $backendUri . $path;
    }

    /**
     * Create a new redirect response to a given backend path.
     * @param $path
     * @param int $status
     * @param array $headers
     * @param null $secure
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect($path, $status = 302, $headers = [], $secure = null)
    {
        return Redirect::to($this->uri() . '/' . $path, $status, $headers, $secure);
    }

    /**
     * Create a new backend redirect response, while putting the current URL in the session.
     * @param $path
     * @param int $status
     * @param array $headers
     * @param null $secure
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectGuest($path, $status = 302, $headers = [], $secure = null)
    {
        return Redirect::guest($this->uri() . '/' . $path, $status, $headers, $secure);
    }

    /**
     * Create a new redirect response to the previously intended backend location.
     * @param $path
     * @param int $status
     * @param array $headers
     * @param null $secure
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectIntended($path, $status = 302, $headers = [], $secure = null)
    {
        return Redirect::intended($this->uri() . '/' . $path, $status, $headers, $secure);
    }
}
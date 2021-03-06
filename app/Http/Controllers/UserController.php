<?php namespace App\Http\Controllers;


use App\Repositories\FileRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends AppController
{

    public function __construct(
        UserRepository $userRepository,
        FileRepository $fileRepository
    )
    {
        parent::__construct();
        $this->userProvider = $userRepository;
        $this->filesProvider = $fileRepository;
        if (\Auth::check()) {

        }
        $this->asset()->add('profile', 'assets/css/profile.css');
    }

    /**
     * Show user profile
     *
     * @return \Response
     */
    public function profile()
    {
        return $this->render('user.profile', ['user' => $this->request->user()]);
    }

    public function edit()
    {
        $this->asset()->add('redactor', 'assets/vendor/redactor/redactor.css');
        $this->asset()->add('redactor', 'assets/vendor/redactor/redactor.min.js', ['jquery']);
        return $this->theme->of('user.edit', ['user' => $this->request->user()])->render();
    }

    public function privacy()
    {
        return $this->theme->of('user.privacy')->render();
    }

    public function update(Request $request)
    {
        $rules = [
            'first_name' => 'required|max:45',
            'last_name' => 'required|max:45',
            'email' => 'required|email|unique:users,email,' . \Auth::id(),
            'username' => 'required|min:3|max:20|unique:users,username,' . \Auth::id(),
            'genre' => 'in:male,female',
            'password' => 'min:6|confirmed',
            'avatar' => 'mimes:jpg,jpeg,bmp,png,gif,svg|max:20000'

        ];
        $this->validate($request, $rules);

        //$user = $this->userProvider->updateDetails(\Auth::id(), $request->except(['avatar', 'birth_date', 'password_confirmation', 'facebook', 'twitter', 'google_plus', 'settings']));
        if ($request->hasFile('avatar')) {
            try {
                $file = $uploadResponse = $this->filesProvider->upload($request->file('avatar'));
            } catch (\Exception $ex) {
                throw $ex;
            }
        }
        \Flash::success('Profile updated');

        return redirect()->action('UserController@edit');
    }

}
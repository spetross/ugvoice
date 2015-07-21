<?php namespace App\Http\Controllers;

use App\Exceptions\LoginFailedException;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Http\Request;

class LoginController extends AppController
{

    protected $auth;

    /**
     * The registrar implementation.
     *
     * @var Registrar
     */
    protected $registrar;

    public function __construct(Guard $auth)
    {
        parent::__construct();
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getIndex()
    {
        return redirect('auth/login');
    }

    /**
     * Show the login page.
     *
     * @return \View
     */
    public function getLogin()
    {
        return $this->render('login.login');
    }

    /**
     * POST login form and determine if admin or standard user and redirect
     * @var Request $request
     * @return \Redirect
     */
    public function postLogin(Request $request)
    {

        $loginFailed = 'Your email or password do not match, please try again';

        $this->validate($request, [
            'email' => 'required', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        try {
            if (!str_contains($credentials['email'], '@')) {
                $credentials['username'] = $credentials['email'];
                unset($credentials['email']);
            }
            if ($this->auth->attempt($credentials, $request->has('remember'))) {
                return redirect()->intended($this->redirectPath());
            } else {
                throw new LoginFailedException($loginFailed);
            }
        } catch (\Exception $ex) {
            \Flash::error($ex->getMessage());
            if ($request->ajax()) {
                return ['error' => $ex->getMessage()];
            }
            return redirect()
                ->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => $ex->getMessage(),
                ]);
        }
    }

    /**
     * Logout's current user
     *
     * @return \Redirect
     */
    public function getLogout()
    {
        $this->auth->logout();

        return redirect()->home();
    }

    /**
     * Show the sign-up page.
     *
     * @return \View
     */
    public function getSignup()
    {
        $this->title = "Sign Up";
        return $this->render('login.signup');
    }

    /**
     * Process the sign-up form and save user
     * @var Request $request
     * @return \Redirect
     */
    public function postSignup(Request $request)
    {
        $rules = [
            'first_name' => 'required|max:45',
            'last_name' => 'required|max:45',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ];

        $this->validate($request, $rules);

        $this->auth->login($this->registrar->create($request->all()));

        return redirect($this->redirectPath());
    }

    protected function redirectPath()
    {
        return $this->request->query('redirect', route('home'));
    }
}

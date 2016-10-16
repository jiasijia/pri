<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use App\Model;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }
	
	public function loginUsername()
    {
        return 'user_name';
    }
	
	public function postLogin(Request $request)
    {
		$result = array('result' => true);
		try
		{
			$validator = Validator::make($request->all(), [
				$this->loginUsername() => 'required',
				'password' => 'required',
			], [
				'user_name.required' => '账号不能为空',
				'password.required' => '密码不能为空',
			]);
			
			if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }
			
			/* If the class is using the ThrottlesLogins trait, we can automatically throttle
			   the login attempts for this application. We'll key this by the username and
			   the IP address of the client making these requests into this application. */
			   
			$throttles = $this->isUsingThrottlesLoginsTrait();

			if ($throttles && $this->hasTooManyLoginAttempts($request)) {
				return $this->sendLockoutResponse($request);
			}

			$credentials = $this->getCredentials($request);

			$user = Model\User::where('user_name', $credentials['user_name'])->first();
			
            if (is_null($user)) {
				throw new \Exception('你他么的别瞎写，没有这用户');
			}
			/*var_dump(Hash::make($credentials['password']));
            var_dump($user->password);*/

			if (!is_null($user) && Hash::check($credentials['password'], $user->password)) {
				if ($user->active == 0) {
					throw new \Exception('你小子的账户没激活，他么的赶紧去激活吧');
				}
				
				if ($user->status == 0) {
					throw new \Exception('小家伙你账号被ban了,回家玩蛋去吧!');
				}
				Auth::login($user, $request->has('remember'));
				
				//$this->handleUserWasAuthenticated($request, $throttles);
			} else {
                throw new \Exception('用户名或密码错误');
            }

			/* If the login attempt was unsuccessful we will increment the number of attempts
			   to login and redirect the user back to the login form. Of course, when this
			   user surpasses their maximum number of attempts they will get locked out.*/
			if ($throttles) {
				$this->incrementLoginAttempts($request);
			}
		    
		} catch (\Exception $e) {
			$result['result'] = false;
            $result['message'] = $e->getMessage();
		}
        return response()->json($result);
    }
	
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            //'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'user_name' => $data['user_name'],
            //'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}

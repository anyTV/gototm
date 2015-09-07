<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Input;
use Session;
use Validator;
use GuzzleHttp\Client;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getLogin()
    {
        return view('login');
    }

    public function getCheckpoint()
    {
        return view('errors.notallowed');
    }

    public function getIndex()
    {
        $data = [
                'service' => 'gototm',
                'redirect_uri' => config('oauth.callback_uri'),
                'response_type' => 'code',
                'roles' => 'profile,email,partner',
                'state' => '/'
            ];

        $param = http_build_query($data);
        $url = config('oauth.base_uri') . '/auth?';

        return redirect()->away($url . $param);
    }

    public function getCallback()
    {
        if (!Input::get('access_token')) {

            return redirect('/au');
        }

        $access_token = Input::get('access_token');
        $state = Input::get('state');

        $client = new Client(['base_uri' => config('oauth.base_uri')]);

        $response = $client->get('/user',
            [ 'headers' => [
                'access-token' => $access_token
                ]
            ]);

        if ($response->getStatusCode() !== 200) {
            return redirect('/')->withErrors(['Unable to login']);
        }

        $user = json_decode($response->getBody(), true);

        if (!preg_match('/.*((\@any\.tv)|(\@freedom\.tm))/', $user['email'])) {
            return redirect('/au/checkpoint');
        }

        Session::put('auth.access_token', $access_token);
        Session::put('auth.user', $user);

        if ($state === NULL || $state === '') {
            $state = '/';
        }

        return redirect($state);
    }

    public function getLogout()
    {
        Session::forget('auth.access_token');
        Session::forget('auth.user');

        return redirect('/');
    }
}

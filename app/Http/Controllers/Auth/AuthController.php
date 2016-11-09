<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\ClientException;
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
        $this->middleware(
            'freedom_oauth',
            ['only' => ['getCallback']]
        );
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
        $state = time();
        session()->put('auth.state', $state);

        $data = [
                'redirect_uri' => config('oauth.callback_uri'),
                'response_type' => 'code',
                'roles' => 'profile,email',
                'client_id' => config('oauth.client_id'),
                'state' => $state
            ];

        $param = http_build_query($data);
        $url = config('oauth.base_uri') . '/oauth?';

        return redirect()->away($url . $param);
    }

    public function getCallback()
    {
        $tokens = request()->session()->get('auth.access_token');

        try {
            $response = request()->client->get(
                'user', [
                'headers' => [
                    'Authorization'=> "Bearer $tokens->access_token"
                ]]
            );
        } catch (ClientException $ex) {

            return redirect('/')
                ->withErrors(['Unable to retrieve user information']);
        }

        $user = json_decode($response->getBody(), true);

        if ( $user['email'] != 'george@freedom.tm' ) {
            return redirect('/')
                ->withErrors(['You are not allowed to use this service']);
        }

        session()->put('auth.user', $user);

        return redirect('/');
    }

    public function getLogout()
    {
        session()->forget('auth');

        return redirect('/');
    }
}

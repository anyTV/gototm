<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class FreedomOauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $inputs = $request->only(['code', 'state']);
        $state = request()->session()->get('auth.state');

        if (!$inputs['code'] || !$inputs['state']) {
            return redirect('/au');
        }

        if (+$inputs['state'] !== $state) {
            return redirect('/')->withErrors(['Invalid request']);
        }

        $data = [
            'grant_type' => 'authorization_code',
            'code' => $inputs['code'],
            'client_id' => config('oauth.client_id'),
            'client_secret' => config('oauth.client_secret'),
        ];

        $client = new Client(['base_uri' => config('oauth.base_uri')]);

        try {
            $response = $client->post(
                'oauth/token',
                ['form_params' => $data]
            );
        } catch (ClientException $ex) {

            return redirect('/')->withErrors(['Unable to login']);
        }

        $tokens = json_decode($response->getBody());
        $request->session()->put('auth.access_token', $tokens);
        $request->client = $client;

        return $next($request);
    }
}

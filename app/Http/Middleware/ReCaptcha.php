<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;

class ReCaptcha
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
        $captcha = $request->input('g-recaptcha-response');

        if ($captcha === '') {
            return redirect()->back()->withErrors(['Please re-enter reCAPTCHA']);;
        }

        $client = new Client(['base_uri' => config('recaptcha.base_uri')]);
        $response = $client->post('siteverify', [
            'form_params' => [
                'secret' => config('recaptcha.secret'),
                'response' => $captcha,
                'remoteip' => $request->getClientIp()
            ]
        ]);

        if ($response->getStatusCode() !== 200) {
            return redirect()->back()->withErrors(['Unknown problem occured']);;
        }

        $response = json_decode($response->getBody(), true);

        if ($response['success'] === false) {
            return redirect()->back()->withErrors(['reCAPTCHA mismatched']);;
        }

        return $next($request);
    }
}

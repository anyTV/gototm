<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRedirectRequest;
use App\Rule;
use App\Visit;
use Session;

class RedirectController extends Controller
{
    function __construct()
    {
        $this->middleware('captcha', ['only' => 'store']);
    }

    public function index()
    {
        if (!Session::has('auth.user')) {
            return view('login');
        }

        return view('home');
    }

    public function goToNewUrl(Request $request, $code)
    {
        $url = Rule::where('short_url', $code)
            ->first();

        if (!$url) {
            $view = view('errors.404');

            return response($view, 404);
        }

        $user_agent = parse_user_agent($request->header('user-agent'));
        $rdr = [
            'ip_address' => $request->getClientIp(),
            'referer' => $request->header('referer'),
            'browser' => $user_agent['browser'],
            'platform' => $user_agent['platform'],
            'country' => $request->header('CF-IPCountry'),
            'browser_version' => $user_agent['version']
        ];

        Visit::create($rdr);

        return redirect()->to($url->long_url);
    }

    public function store(CreateRedirectRequest $request)
    {
        $input = $request->only('long_url', 'short_url');

        Rule::create($input);

        return redirect()->action('RedirectController@success',
            [urlencode($input['short_url'])]);
    }

    public function success($url)
    {
        $rule = Rule::where('short_url', $url)
            ->first();

        if (!$rule) {
            $view = view('errors.404');

            return response($view, 404);
        }

        return view('success')->with('data', $rule);
    }
}

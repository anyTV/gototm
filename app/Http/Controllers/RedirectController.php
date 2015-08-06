<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRedirectRequest;
use App\Rule;
use App\Visit;

class RedirectController extends Controller
{
    function __construct()
    {
        $this->middleware('captcha', ['only' => 'store']);
    }

    public function index()
    {
        return view('home');
    }

    public function goToNewUrl(Request $request, $code)
    {
        $url = Rule::where('short_url', $code)
            ->first();

        if (!$url) {
            return view('errors.404');
        }

        $user_agent = parse_user_agent();
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
            return view('errors.404');
        }

        return view('success')->with('data', $rule);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRedirectRequest;
use App\Rule;

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

    public function goToNewUrl($code)
    {
        $url = Rule::where('short_url', $code)
            ->first();

        if (!$url) {
            return view('errors.404');
        }

        return redirect()->to($url->long_url);
    }

    public function store(CreateRedirectRequest $request)
    {
        $input = $request->only('long_url', 'short_url');
        Rule::create($input);

        return redirect()->action('RedirectController@success',
            [$input['short_url']]);
    }

    public function success($url)
    {
        $rule = Rule::where('short_url', $url)
            ->first()->toArray();

        return view('monitor')->with('data', $rule);
    }
}

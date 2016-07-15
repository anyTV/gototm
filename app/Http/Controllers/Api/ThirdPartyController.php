<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use Input;
use App\Rule;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRedirectRequest;

class ThirdPartyController extends Controller
{

    public function __construct() {
        $this->middleware('third_party_access');
    }

    public function postLink () {
        $input = Input::only('short_url', 'long_url');

        Rule::create($input);

        return response()->json([
          'message' => 'Successfully Created',
          'meta' => $input
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use Input;
use Validator;
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

        $validation = Validator::make($input, [
            'short_url' => 'required|min:2',
            'long_url' => 'required|max:2083'
        ]);

        if ($validation->fails()) {
            return response()->json([
                $validation->errors()
            ], 400);
        }

        try {
            Rule::create($input);
        } catch (Exception $ex) {
            return response()->json([
                'message' =>
                    'Server failed to create redirect rule: ' .
                    $ex->getMessage()
            ], 500);
        };

        return response()->json([
            'message' => 'Successfully Created',
            'meta' => $input
        ]);
    }
}

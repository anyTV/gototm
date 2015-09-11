<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use Input;
use Session;
use App\Rule;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRedirectRequest;

class UserController extends Controller
{
    public function __contruct()
    {
        $this->middleware('csrf');
    }

    public function getLinks()
    {
        $queryString = Input::get('q');
        $email = Session::get('auth.user.email');
        $links = Rule::orderBy('created_at', 'asc');

        if (!in_array($email, config('sys_admin'))) {
            $links->where('email', $email);
        }

        if ($queryString && $queryString != '') {
            if (filter_var($queryString, FILTER_VALIDATE_EMAIL)) {
                $links->where('email', $queryString);
            }
            else if (filter_var($queryString, FILTER_VALIDATE_URL)) {
                $links->where('long_url', $queryString);
            }
            else {
                $links->where('email', 'like', '%' . $queryString . '%')
                    ->orWhere('short_url', 'like', '%' . $queryString . '%')
                    ->orWhere('long_url', 'like', $queryString . '%');
            }
        }

        $links = $links->paginate(15);

        return response()->json($links);
    }

    public function postLinks(UpdateRedirectRequest $request)
    {
        $input = $request->only('_id', 'long_url',
            'short_url', '_to_edit');

        $rule = Rule::where('_id', $input['_id'])->first();

        if (isset($rule[$input['_to_edit']])) {
            $rule[$input['_to_edit']] = $input[$input['_to_edit']];
            $rule->updated_at = Carbon::now();

            $rule->save();
        }

        return response()->json($rule);
    }

    public function deleteLinks()
    {
        $input = Input::only('_id');

        $rule = Rule::where('_id', $input['_id'])->delete();

        return response()->json($rule);
    }

}

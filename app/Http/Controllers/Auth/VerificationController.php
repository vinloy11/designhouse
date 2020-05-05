<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Env\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\URL;

//use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(Request $request, User $user)
    {
        if (! URL::hasValidSignature($request)) {
            return response()->json(["errors" => [
                "message" => "Invalid verification link"
            ]], 422);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(["errors" => [
                "message" => "Email address already verified"
            ]], 422);
        }

        $user->markEmailAsVerified();
        event(new Verified($user));

        return response()->json(["message" => "Email successfully verified"], 200);
    }

    public function resend(Request $request)
    {

    }
}

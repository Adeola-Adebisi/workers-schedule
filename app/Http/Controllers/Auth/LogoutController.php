<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Attributes;

class LogoutController extends Controller
{


    /**
    * @OA\Post(
    * path="/api/logout",
    * summary="Logout",
    * description="Logout user and invalidate token",
    * operationId="authLogout",
    * tags={"auth"},
    * security={{"sanctum":{}}},
    * @OA\Response(
    *    response=200,
    *    description="Success"
    *     ),
    * 
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * )
     */
   
    public function logout(Request $request){
        
        auth()->user()->tokens()->delete();
        return response([
             'message'=>'logged out'
        ]);

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes;

  /**
     * @OA\OpenApi(
     *   @OA\Server(
     *      url="/api"
     *   ),
     *   @OA\Info(
     *      title="Swagger-Demo",
     *      version="1.0.0",
     *   ),
     * ),
     */



    /**
     *@OA\Tag(name="UnAuthorize", description="No user login required")
     */

    /**
     *@OA\Tag(name="Authorize", description="User login required")
     */




  

class Controller extends BaseController
{
 

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

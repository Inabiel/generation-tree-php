<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Generation Tree API",
 *      description="Generation Tree API",
 *      @OA\Contact(
 *          email="nizzullah@gmail.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="API Server"
 * )

 *
 * @OA\Tag(
 *     name="Generation Tree Members",
 *     description="API Endpoints of Generation Tree Members"
 * )
 */
class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\Shift;
use App\Traits\ShiftTrait;
use DB;
class Shiftcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     /**
     * @OA\Get(
     *     path="/api/shifts",
     *     operationId="shiftTable",
     *      tags={"Shift for workers"},
     *      summary="Three shifts a day, Shift1: 0-8 hour, Shift2: 8-16 hour, Shift3: 16-24 hour",
     *      description="Returns Workers Schedule, For better accuracy and better shift distribution, the schedule is map to 365 days(A Year) where the Id corresponds to the day of the year.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#")
     *       ),
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
    public function index(Worker $worker)
    {
        $shift = Shift::all();
        if (count($shift)==null) {
            return ["message"=>"no worker has been added"];
            # code...
        }else {return $shift;}
      
    }

    
}

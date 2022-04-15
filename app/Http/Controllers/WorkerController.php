<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\Shift;
use App\Traits\ShiftTrait;
use DB;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="L5 OpenApi",
 *      description="L5 Swagger OpenApi description"
 * ),
 * @OA\SecurityScheme(
     *       scheme="Bearer",
     *       securityScheme="sanctum",
     *       type="apiKey",
     *       in="header",
     *       name="Authorization",
     
     * )
 */

class WorkerController extends Controller
{
    
    use ShiftTrait;

   
    /**
     * @OA\Get(
     *     path="/api/workers",
     *     operationId="getWorker",
     *      tags={"All workers"},
     *      summary="All available workers",
     *      description="Returns a list of all the current workers that can be assigned a shift",
     *      
     *     @OA\Response(
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
     *  
     */

    public function index(){
        return Worker::all();
    }

/**
     * @OA\Post(
     *      path="/api/workers",
     *      operationId="storeProject",
     *      tags={"New worker"},
     *      summary="Add new a worker to the existing workers",
     *      description="Returns (Operation Successful) and the newly added worker is instantly assigned a shift to them ",
     *      security={{"sanctum":{}}},
     *      @OA\RequestBody(
     *    description="Pass worker credentials",
     *    @OA\JsonContent(
     *       required={"name","id"},
     *       @OA\Property(property="name", type="string", example="worker1"),
     *       
     *    ),
     * ),
     *          @OA\Response(
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
    
    public function store(Request $request, Worker $worker){
        
$name = $request->input('name');
request()->validate([
    'name'=>'required'
]);
$success= false;
$message="";
$new_user = $worker::where('name','=',$name)->first();
if ($new_user===null) {
    # code...

Worker::create([
        'name'=>$name
       
]);
$success=true;
return $this->ShiftStorage($worker);

//$message='successful';
}else{$message="name exists";}
return [
    'message'=>$message
];






    }


     /**
     * @OA\Put(
     *      path="/api/workers",
     *      operationId="updateWorker",
     *      tags={"Update worker"},
     *      summary="Update worker: Change workers name or asign a new name to them",
     *      description="Returns (updated) if successful and updates workerss names on the shift table", 
     *      security={{"sanctum":{}}},
     * @OA\RequestBody(
 *    required=true,
 *    description="Pass worker credentials",
     *  @OA\JsonContent(
 *       required={"name","id"},
 *       @OA\Property(property="name", type="string", example="worker1"),
 *       @OA\Property(property="id", type="integer", example="1"),
 *       
 *    ),
 * ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#")
     *      ),
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

    
    public function update(Worker $worker, Request $request, Shift $shift){
        
        request()->validate([
            'id'=>['required','integer'],
            'name'=>['required','string']
        ]);
        $id=$request->input('id');
        $param = $worker::find($id,'name');
       // return ["message"=>$param];
        if($param==null){
        return['message'=>'no worker found please check the worker id and try again'];
        }
        $new_user = $worker::where('name','=',$request->input('name'))->first();
        if ($new_user===null) {


        $worker->where('id',$id)->update([
            'name'=>$request->input('name')
        ]);

        
        $param= $param->name;
        //return $param;
        $shift_id1 = DB::table('shifts')->where('shift1','=',"$param")->pluck('id');
        $shift_id2 = DB::table('shifts')->where('shift2','=',"$param")->pluck('id');
        $shift_id3 = DB::table('shifts')->where('shift3','=',"$param")->pluck('id');
        //return ["message"=>$shift_id1];
        
        if (!empty($shift_id1)) {
            # code...
        
        DB::table('shifts')->whereIn('id',$shift_id1)->update([
            'shift1'=>$request->input('name')
        ]);
        }
        
        if (!empty($shift_id2)) {
            # code...
        DB::table('shifts')->whereIn('id',$shift_id2)->update([
            'shift2'=>$request->input('name')
        ]);
        }
        
        if (!empty($shift_id3)) {
            # code...
        DB::table('shifts')->whereIn('id',$shift_id3)->update([
            'shift3'=>$request->input('name')
        ]);
        }return['message'=>'updated'];
    }else {
        return['message'=>'name exists'];
    } 
    }
  // delete worker method    

   /**
     * @OA\Delete(
     *      path="/api/workers",
     *      operationId="deleteWorker",
     *      tags={"Delete Worker"},
     *      summary="Delete a worker from record and updates the shift table",
     *      description="Deletes a record and returns success message if operation was successful and also recreates the shift table to compensate for the shift of the deleted worker",
     *      security={{"sanctum":{}}},
     *      @OA\RequestBody(
     *    description="Pass worker id",
     *    @OA\JsonContent(
     *       required={"id"},
     *       @OA\Property(property="id", type="integer", example="1"),
     *       
     *    ),
     * ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(Request $request,Worker $worker){
        request()->validate([
            'id'=>['required','integer']
        ]);
        $id=$request->input('id');
        $new_user = Worker::where('id','=',$request->input('id'))->first();
        if ($new_user!==null) {

        $worker->findOrFail($id)->delete();

        return $this->ShiftStorage($worker);

    }else{return [
        'message'=>'no record found please check that the id is correct'
    ];
    }


}
}
<?php

namespace App\Traits;
use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\Shift;
use DB;

trait ShiftTrait{
public function ShiftStorage($worker){
    $precision=365;
DB::table('shifts')->truncate();

# code...
function createshift($array){
   ini_set('max_execution_time', 120 ) ; 
   return Shift::create([
       'shift1'=>$array[0]??'default',
       'shift2'=>$array[1]??'default',
       'shift3'=>$array[2]??'default',
       ]);
   }
  
$name=$worker->pluck('name')->toArray();
$days_unique = floor(count($name)/3);
$remainder = count($name)%3;
$all_days=[];
//when the workers are a multiple of 3
$newArray= array_slice($name, 0, 3);
$left=array_diff($name,$newArray);

for ($i=0; $i < $days_unique+1; $i++) { 
    # code...
array_push($all_days,$newArray);
$newArray= array_slice($left, 0, 3);
$left= array_diff($left,$newArray);


}
//return $all_days[$days_unique];
if($name!=null &&$days_unique==0){

    for ($i=0; $i < $precision; $i++) { 
        # code...
        createshift($all_days[0]);
    }
       
}
if($days_unique!=0&&$remainder!=0){
for ($i=0; $i < $days_unique; $i++) { 
    # code...
    createshift($all_days[$i]);
    $iteration=$i;
} 
}
if ($remainder==0) {
    $iteration=0;
    # code...
    while ($iteration<$precision) {
        # code...
        for ($i=0; $i < $days_unique; $i++) { 
            # code...
            createshift($all_days[$i]);
            $iteration++;
            if($iteration==$precision){
                break 2;
            }
            if ($i+1==count($all_days)) {
                # code...
                $i=-1;
            }
        } 
    }
}
if ($remainder!=0&&$days_unique>0) {
    $remainder = $all_days[$days_unique];
    $all_days_new=[];
    $iteration = $days_unique;
    for ($i=0; $i < $precision; $i++) { 
        # code...
        
        $array_new=array_merge($remainder,$all_days[$i]);
        $array_next=array_slice($array_new, 0, 3);
        $remainder=array_diff($array_new,$array_next);
        createshift($array_next);
        array_push($all_days_new,$array_next);
        $iteration++;
        if($iteration==$precision){
        break;
        }
        if(count($all_days)==$i+2){
            array_push($all_days_new,$remainder);
            //return $remainder;
            //$remainder = $all_days_new[$days_unique];
            $all_days=$all_days_new;
            $all_days_new=[];
            $i=-1;
        }
    }

    
}
return ["message"=>"Operation successful"];
}
}
//when the workers are not a multiple of 3


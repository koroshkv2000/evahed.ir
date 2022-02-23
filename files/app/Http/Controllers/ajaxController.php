<?php

namespace App\Http\Controllers;

use App\Models\branches;
use App\Models\courses;
use Illuminate\Http\Request;
use App\models\majors;

class ajaxController extends Controller
{
    public function majorList(){
        return majors::get(["id","name"]);
    }
    public function branchList($major_id){
        return branches::where("major",$major_id)->get(["id","name"]);
    }
    public function courseList($branch_id){
        return courses::where("branch",$branch_id)->get(["id","name"]);
    }
    public function courseValidation(Request $request){
        $errors = [];
        $request->curent = json_decode($request->curent);
        $request->last = json_decode($request->last);
        $vahed = 0;
        $maeref = 0;
        foreach ($request->curent as $curent){

            $curentItem = courses::find($curent);
            $vahed += $curentItem->vahed;
                if (!empty($curentItem->pish1) && !in_array($curentItem->pish1, $request->last)){
                    array_push($errors,[
                        "error"=>1,
                        "name"=>$curentItem->name,
                        "pish"=>courses::find($curentItem->pish1)->name,
                    ]);
                }
            if (!empty($curentItem->pish2) && !in_array($curentItem->pish2, $request->last)){
                array_push($errors,[
                    "error"=>1,
                    "name"=>$curentItem->name,
                    "pish"=>courses::find($curentItem->pish2)->name,
                ]);
            }
            if (!empty($curentItem->ham) && !in_array($curentItem->ham, $request->curent)){
                array_push($errors,[
                    "error"=>3,
                    "name"=>$curentItem->name,
                    "ham"=>courses::find($curentItem->ham)->name,
                ]);
            }
            if ($curentItem->categories == 1){
                $maeref++;
            }

        }
        if ($vahed >= 24){
            array_push($errors,[
                "error"=>2,
            ]);
        }
        if ($maeref > 1){
            array_push($errors,[
                "error"=>4,
            ]);
        }
        return $errors;
    }
}

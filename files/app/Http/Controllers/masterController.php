<?php

namespace App\Http\Controllers;

use App\Models\courses;
use Illuminate\Http\Request;

class masterController extends Controller
{
    public function scoreCource($courseId){
        $score = 0;
        $course = courses::find($courseId);
        if (!empty($course->pish1)) {
            $score += masterController::scoreCource($course->pish1) + 1;
        }
        if (!empty($course->pish2)){
            $score += masterController::scoreCource($course->pish2) + 1;
        }



        return $score;
    }
    public function test()
    {
        $courses = courses::all();
        foreach ($courses as $c){

            $score = masterController::scoreCource($c->id);
            $c->score = $score;
        }

        return $courses->sortByDesc("name");
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\RemindProjectShipped;
use App\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CronController extends Controller {
    public function start() {
        $this->echDay();

    }

    public function echDay() {

//        $date = today()->subDays(2);
//        $projects = Project::where('updated_at','<',$date)->get()->groupBy('creater_id');
//        foreach($projects as $key =>$projects_group){
//            $user = User::find($key);
//            Mail::to($user->email)->send(new RemindProjectShipped(['projects'=>$projects_group]));
//        }

    }
}

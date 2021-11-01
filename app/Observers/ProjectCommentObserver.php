<?php

namespace App\Observers;

use App\Mail\ProjectCommentShipped;
use App\Project;
use App\ProjectComment;
use App\ProjectMessage;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ProjectCommentObserver
{
    /**
     * Handle the project comment "created" event.
     *
     * @param  \App\ProjectComment  $projectComment
     * @return void
     */
    public function creating(ProjectComment $projectComment)
    {
       $msg = ProjectMessage::find($projectComment->message_id);
       $proj = Project::find($msg->project_id);
       if($projectComment->is_client){
          $user = User::find($proj->creater_id);
       } else {
           $user = User::find($proj->client_id);
       }
        Mail::to($user->email)->send(new ProjectCommentShipped(['name'=>$user->name,'id'=>$msg->project_id]));
    }

    /**
     * Handle the project comment "updated" event.
     *
     * @param  \App\ProjectComment  $projectComment
     * @return void
     */
    public function updated(ProjectComment $projectComment)
    {
        //
    }

    /**
     * Handle the project comment "deleted" event.
     *
     * @param  \App\ProjectComment  $projectComment
     * @return void
     */
    public function deleted(ProjectComment $projectComment)
    {
        //
    }

    /**
     * Handle the project comment "restored" event.
     *
     * @param  \App\ProjectComment  $projectComment
     * @return void
     */
    public function restored(ProjectComment $projectComment)
    {
        //
    }

    /**
     * Handle the project comment "force deleted" event.
     *
     * @param  \App\ProjectComment  $projectComment
     * @return void
     */
    public function forceDeleted(ProjectComment $projectComment)
    {
        //
    }
}

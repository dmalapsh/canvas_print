<?php

namespace App\Observers;

use App\Mail\ProjectMessageShipped;
use App\Project;
use App\ProjectMessage;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ProjectMessageObserver {
    /**
     * Handle the project message "created" event.
     *
     * @param \App\ProjectMessage $projectMessage
     * @return void
     */
    public function created(ProjectMessage $projectMessage) {
        $proj      = Project::find($projectMessage->project_id);
        $user      = User::find($proj->client_id);
        $user_mail = $user->email;
        $user_name = $user->name;
        $poject_id = $projectMessage->project_id;
        $proj->update(['updated_at' => now(+3)]);
        //уведы слать будем
        Mail::to($user_mail)->send(new ProjectMessageShipped(['name' => $user_name, 'id' => $poject_id]));


//        Mail::send('email.verify', '$data',  function($message) use ($to_name, $to_email) {
//            $message->subject('Верификация аккаунта')->to($to_email, $to_name);
//        });
    }

    /**
     * Handle the project message "updated" event.
     *
     * @param \App\ProjectMessage $projectMessage
     * @return void
     */
    public function updating(ProjectMessage $projectMessage) {
        if($projectMessage->closing && $projectMessage->approved) {
            $item           = Project::find($projectMessage->project_id);
            $item->ended_at = now(+3);
            $item->save();
        }
    }

    /**
     * Handle the project message "deleted" event.
     *
     * @param \App\ProjectMessage $projectMessage
     * @return void
     */
    public function deleted(ProjectMessage $projectMessage) {
        //
    }

    /**
     * Handle the project message "restored" event.
     *
     * @param \App\ProjectMessage $projectMessage
     * @return void
     */
    public function restored(ProjectMessage $projectMessage) {
        //
    }

    /**
     * Handle the project message "force deleted" event.
     *
     * @param \App\ProjectMessage $projectMessage
     * @return void
     */
    public function forceDeleted(ProjectMessage $projectMessage) {
        //
    }
}

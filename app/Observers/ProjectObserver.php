<?php

namespace App\Observers;

use App\Helpers\MainHelpers;
use App\Http\Controllers\ProjectMessageController;
use App\Project;
use App\ProjectMessage;

class ProjectObserver {
    /**
     * Handle the project "created" event.
     *
     * @param \App\Project $project
     * @return void
     */
    public function created(Project $project) {
        //
    }

    /**
     * Handle the project "updated" event.
     *
     * @param \App\Project $project
     * @return void
     */
    public function updating(Project $project) {
        $original = $project->getOriginal();
        $result   = $project->getDirty();
        $msg = MainHelpers::wrapProjectDiff($result);
        if($msg){
            $item = new ProjectMessage(['project_id'=>$project->id, 'text'=>$msg]);
            $item->save();
        }
//        dd($result, $original, $project->project_results);

    }

    /**
     * Handle the project "deleted" event.
     *
     * @param \App\Project $project
     * @return void
     */
    public function deleted(Project $project) {
        //
    }

    /**
     * Handle the project "restored" event.
     *
     * @param \App\Project $project
     * @return void
     */
    public function restored(Project $project) {
        //
    }

    /**
     * Handle the project "force deleted" event.
     *
     * @param \App\Project $project
     * @return void
     */
    public function forceDeleted(Project $project) {
        //
    }
}

<?php

namespace App\Observers;

use App\Models\FavoriteCandidate;
use App\Models\Remark;
use App\Repositories\RemarkRepository;

class FavoriteCandidateObserver
{
    /**
     * Handle the favorite candidate "created" event.
     *
     * @param  \App\models\FavoriteCandidate  $favoriteCandidate
     * @return void
     */
    public $remarkRepository;

    public function __construct(RemarkRepository $remarkRepo)
    {
        $this->remarkRepository = $remarkRepo;
    }

    public function created(FavoriteCandidate $favoriteCandidate)
    {
        //
    }

    /**
     * Handle the favorite candidate "updated" event.
     *
     * @param  \App\FavoriteCandidate  $favoriteCandidate
     * @return void
     */
    public function updated(FavoriteCandidate $favoriteCandidate)
    {
        //
    }

    /**
     * Handle the favorite candidate "deleted" event.
     *
     * @param  \App\FavoriteCandidate  $favoriteCandidate
     * @return void
     */
    public function deleted(FavoriteCandidate $favoriteCandidate)
    {
        if ($favoriteCandidate->deleted_at != null) {
            $favoriteCandidate->is_deleted = 1;
            $favoriteCandidate->save();
            Remark::where('shortlisted_id', '=', $favoriteCandidate->id)->update(['is_deleted' => 1]);
            Remark::where('shortlisted_id', '=', $favoriteCandidate->id)->delete();
        }
    }

    /**
     * Handle the favorite candidate "restored" event.
     *
     * @param  \App\FavoriteCandidate  $favoriteCandidate
     * @return void
     */
    public function restored(FavoriteCandidate $favoriteCandidate)
    {
        //
    }

    /**
     * Handle the favorite candidate "force deleted" event.
     *
     * @param  \App\FavoriteCandidate  $favoriteCandidate
     * @return void
     */
    public function forceDeleted(FavoriteCandidate $favoriteCandidate)
    {
        //
    }
}

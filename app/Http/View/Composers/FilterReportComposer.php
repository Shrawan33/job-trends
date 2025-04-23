<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class FilterReportComposer
{
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $freePaidFilter = [];
        switch ($view->getName()) {
            case 'filter_reports.employer':
                    $freePaidFilter = config('constants.free_paid_filter', 1);
                break;
            case 'filter_reports.jobseeker':
                break;
            case 'filter_reports.package':
                break;
            case 'filter_reports.job':
                $freePaidFilter = config('constants.free_paid_filter', 1);

                break;
        }

        $view->with([
            'freePaidFilter' => $freePaidFilter,
        ]);
    }
}

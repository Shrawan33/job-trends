<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Repositories\OrderDetailRepository;
class OrderComposer
{
    private $orderRepository;
    public function __construct(OrderDetailRepository $orderRepo) {
        $this->orderRepository = $orderRepo;

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $orserFilter = ['' => config('constants.payment_status', [])];
        if ($view->getName() == 'users.load_pdf') {
            $response = $this->orderRepository->getCvPdf($view->jobseeker->id);
        }
        $view->with([
            'orserFilter' => $orserFilter,
        ]);
    }
}

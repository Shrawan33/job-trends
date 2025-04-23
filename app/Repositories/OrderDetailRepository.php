<?php

namespace App\Repositories;

use App\Helpers\FunctionHelper;
use App\Models\OrderDetail;
use App\Models\OrderHeader;
use App\Repositories\BaseRepository;

/**
 * Class OrderDetailRepository
 * @package App\Repositories
 * @version September 9, 2023, 12:51 pm UTC
*/

class OrderDetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_number',
        'created_at'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderHeader::class;
    }
    public function getCvPdf($id, $name = '')
    {
        $input = $this->createInputDataForPdf($id);
        // dd($input);
        $input->order_number = $input->order_number;
        // dd(str_replace(' ', 'no-data', $input->file_name) . '-CV.pdf');
        $name = ($input->order_number == ' ') ? str_replace(' ', 'no-data', $input->order_number) . '-CV.pdf' : $input->order_number . '-CV.pdf';

        return FunctionHelper::preparePdf($input, 'users.make_a_order', true, true, $name);
    }
    public function createInputDataForPdf($id)
    {
        $input = [];

        //get created by user info

        $order = $this->find($id, ['*'], true);
        if (!empty($order))
        {
            $input = $this->model->prepareInput($order);
        }

        return $input;
    }

}

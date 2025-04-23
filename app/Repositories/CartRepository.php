<?php

namespace App\Repositories;

use App\Models\ShoppingCart;
use App\Repositories\BaseRepository;

/**
 * Class CartRepository
 * @package App\Repositories
 * @version September 1, 2023, 6:32 am UTC
*/

class CartRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

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
        return ShoppingCart::class;
    }

    public function createOrUpdateCart($userId, $cartItems)
    {

        return $this->model->updateOrCreate(
            ['user_id' => $userId],
            ['cart_items' => $cartItems]
        );
    }

    public function getCartItems($userId)
    {
        $cart = $this->model->where('user_id', $userId)->first();
        //dd($cart);
        return $cart ? $cart : [];
    }
    public function getCartAddonPackages($userId, $package_category_id) {

    }
    public function getCartCount($userId)
    {
        $cart = $this->model->where('user_id', $userId)->first();
        return $cart;
    }
}

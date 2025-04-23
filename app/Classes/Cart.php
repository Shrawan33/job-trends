<?php
namespace App\Classes;

use App\Models\Configuration;
use App\Repositories\CartRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\PackageRepository;
use Illuminate\Support\Facades\Auth;

class Cart
{
    public $cartRepository;
    public $packageRepository;
    public $orderDetailRepository;
    protected $cartItems = [];
    protected $cartId = '';
    protected $package_category_id = '';

    public function __construct(CartRepository $cartRepo, PackageRepository $packageRepo, OrderDetailRepository $orderDetailRepo)
    {
        $this->cartRepository = $cartRepo;
        $this->packageRepository = $packageRepo;
        $this->orderDetailRepository = $orderDetailRepo;
    }

    public function addToCart($productId, $quantity = 1)
    {
        $userId = Auth::id();

        // Retrieve the user's shopping cart or create a new one
        $cart = $this->cartRepository->getCartItems($userId);
        $cartItems = $cart->cart_items ?? [];//dd($cartItems);
        $packageInfo = $this->packageRepository->find($productId);

        // Use array_column to extract the 'package_type' column from 'package_info'
        $packageTypes = array_column($cartItems, 'package_info');

        // Extract 'package_type' from the 'package_info' sub-array
        $packageTypes = array_column($packageTypes, 'package_type');

        //dd($packageTypes);
        $package_type = $packageInfo['package_type'];
        //dd(count(array_unique($packageTypes)));
        // Check if the specified package type exists and if there are other values besides it

        if (!in_array($package_type, $packageTypes) && count(array_unique($packageTypes)) >= 1) {
            $cartItems['error'] = 1;
            return $cartItems;
        }

        $cartItems[$productId]['id'] = $productId;
        $cartItems[$productId]['title'] = $packageInfo->title;
        $cartItems[$productId]['price'] = $packageInfo->price;
        $cartItems[$productId]['package_category_id'] = $packageInfo->package_category_id;
        $cartItems[$productId]['quantity'] = $quantity;
        $cartItems[$productId]['package_info'] = $packageInfo;

        // Create or update the shopping cart
        $this->cartRepository->createOrUpdateCart($userId, $cartItems);
        $this->cartItems = $cartItems;
        return $cartItems;
    }

    public function getCartItems()
    {
        $userId = Auth::id();
        $cart = $this->cartRepository->getCartItems($userId);

        $this->cartItems = $cart->cart_items??null;
        $this->cartId = $cart->id??null;
        // Retrieve the user's shopping cart items
        return $cart->cart_items??null;
    }

    public function getAddonItems() {

        $userId = Auth::id();
        $addonPackageInfo = $this->packageRepository->all(['is_addon' => 1, 'package_category_id' => $this->package_category_id]);
        return $addonPackageInfo;
    }

    public function getItems()
    {
        return $this->cartItems;
    }

    public function getCartid()
    {
        return $this->cartId;
    }

    public function getTotal()
    {
        $total = 0;

        if ($this->cartItems) {
            foreach ($this->cartItems as $item) {

                $total += $item['price'] * $item['quantity'];
                // if ($item['package_info']['package_type'] == 3) {
                //     $gst_percentage = Configuration::getSessionConfigurationName(['pricing'], null, 'gst');
                //     $total += ($item['price'] * ($gst_percentage / 100));
                // }
                $this->package_category_id = $item['package_category_id'];
            }
        }


        return $total;
    }



    public function removeFromCart($productId) {
        $userId = Auth::id();

        // Retrieve the user's shopping cart or create a new one
        $cart = $this->cartRepository->getCartItems($userId);
        $cartItems = $cart->cart_items;
        $packageInfo = $this->packageRepository->find($productId);
        if (isset($cartItems[$productId])) {
            unset($cartItems[$productId]);
        }
        $this->cartRepository->createOrUpdateCart($userId, $cartItems);
        $this->cartItems = $cartItems;
        return $cartItems;
    }

    public function getorders() {
        $userId = Auth::id();
        return $this->orderDetailRepository->all(['user_id' => $userId]);
    }

}

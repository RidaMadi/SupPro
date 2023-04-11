<?php

namespace App\Http\Controllers\Market\Repository;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Factory;
use App\Models\HistoryOrder;
use App\Models\Market;
use App\Models\NotificationMarket;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarketRepository extends Controller
{
    private $history_order,$subCategory,$category,$factory, $ad, $offer, $order, $product, $productOrder, $market, $user, $notificationMarket;

    public function __construct(HistoryOrder $history_order,SubCategory $subCategory,Category $category,Factory $factory, Ad $ad, Offer $offer, Order $order, Product $product, ProductOrder $productOrder, Market $market, User $user, NotificationMarket $notificationMarket)
    {
        $this->factory = $factory;
        $this->ad = $ad;
        $this->offer = $offer;
        $this->order = $order;
        $this->product = $product;
        $this->productOrder = $productOrder;
        $this->market = $market;
        $this->user = $user;
        $this->notificationMarket = $notificationMarket;
        $this->category = $category;
        $this->subCategory = $subCategory;
        $this->history_order = $history_order;
    }


    public function getAllFactory()
    {
        return $this->factory->select('id', 'name', 'logo')
            ->where('delete', 0)
            ->where('active', 1)
            ->paginate(10);
    }

    public function getAllAds()
    {
        return $this->ad->where('ads.delete', 0)
            ->where('ads.active', 1)
            ->join('factories', 'ads.factory_id', '=', 'factories.id')
            ->select('ads.id', 'factories.name as factory_name', 'ads.factory_id', 'ads.title', 'ads.description', 'ads.photo')
            ->orderBy('ads.id', 'desc')
            ->paginate(10);
    }

    public function getProductToHomePage()
    {
        return $this->factory
            ->select('factories.id as factory_id','factories.name as factory_name','factories.logo',
                'products.id as product_id','products.name as product_name','products.price','products.photo','products.description')
            ->where('factories.delete', 0)
            ->where('factories.active', 1)
            ->join('categories', 'categories.factory_id', '=', 'factories.id')
            ->join('sub_categories', 'sub_categories.category_id', '=', 'categories.id')
            ->join('products', 'products.subCategory_id', '=', 'sub_categories.id')
            ->inRandomOrder('products.id')
            ->paginate(10,['*'],'faults_page');

    }

    public function searchFactoryByName($name){
        return $this->factory->where('name', 'like', '%' . $name . '%')
            ->select('id', 'name', 'logo')
            ->paginate(10);
    }

    public function getOfferForFactory($factory_id){
        return $this->factory
            ->select('products.name as product_name','products.photo','offers.title','offers.description')
            ->where('factories.id',$factory_id)
            ->where('factories.delete', 0)
            ->where('factories.active', 1)
            ->join('categories', 'categories.factory_id', '=', 'factories.id')
            ->join('sub_categories', 'sub_categories.category_id', '=', 'categories.id')
            ->join('products', 'products.subCategory_id', '=', 'sub_categories.id')
            ->join('offers', 'offers.product_id', '=', 'products.id')
            ->orderBy('offers.id','desc')
            ->paginate(10);
    }

    public function getAllCategoryForFactory($factory_id){
        return $this->factory
            ->select('categories.name','categories.id')
            ->where('factories.id',$factory_id)
            ->where('factories.delete', 0)
            ->where('factories.active', 1)
            ->join('categories', 'categories.factory_id', '=', 'factories.id')
            ->paginate(40);
    }


    public function getAllSubCategoryForFactory($category_id){
        return $this->category
            ->select('sub_categories.name','sub_categories.id')
            ->where('categories.id',$category_id)
            ->join('sub_categories', 'sub_categories.category_id', '=', 'categories.id')
            ->paginate(40);
    }

    public function getAllProductForSubCategory($subCategory_id)
    {
        return $this->subCategory
            ->select('products.name','products.id','products.photo','products.price','products.description')
            ->where('sub_categories.id',$subCategory_id)
            ->join('products', 'products.subCategory_id', '=', 'sub_categories.id')
            ->paginate(10);
    }

    public function createOrder($products,$market_id,$factory_id){
        $order = $this->order->create([
           'factory_id' => $factory_id,
           'market_id' => $market_id,
           'accept' => 'wait',
        ]);

        foreach ($products as $o) {
            $this->productOrder->create([
                'order_id' => $order->id,
                'product_id' => $o[0],
                'amount' => $o[1],
            ]);
        }
    }


    public function getWaitAcceptOrder($market_id){
        return $this->order->where('market_id',$market_id)
            ->select('orders.id as order_id','orders.accept','orders.time_for_delivery'
                ,'orders.created_at','factories.name')
            ->join('factories', 'factories.id','=','orders.factory_id')
            ->orderBy('orders.id','desc')
            ->paginate(50);

    }

    public function getRejectCompleteOrder($market_id){
        return $this->history_order->where('market_id',$market_id)
            ->select('history_orders.id as order_id','history_orders.accept','history_orders.time_for_delivery'
                ,'history_orders.created_at','factories.name')
            ->join('factories', 'factories.id','=','history_orders.factory_id')
            ->orderBy('history_orders.id','desc')
            ->paginate(50);

    }
}

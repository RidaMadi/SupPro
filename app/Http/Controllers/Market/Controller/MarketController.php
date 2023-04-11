<?php

namespace App\Http\Controllers\Market\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Market\Repository\MarketRepository;
use App\Http\Requests\createOrder;
use App\Http\Requests\getAllProductForSubCategory;
use App\Http\Requests\getAllSubCategoryForFactory;
use App\Http\Requests\getHistoryOrder;
use App\Http\Requests\getOfferFactory;
use App\Http\Requests\searchFactoryName;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarketController extends Controller
{
    use GeneralTrait;

    private $repository;

    public function __construct(MarketRepository $marketRepository)
    {
        $this->repository = $marketRepository;
    }

    private function getPhoto($folderName, $photoName)
    {
        return asset($folderName . $photoName);
    }

    public function getAllFactory()
    {
        try {
            $factory = $this->repository->getAllFactory();
            foreach ($factory as $f) {
                $f->logo = $this->getPhoto('factory_logo/', $f->logo);
            }

            return $this->returnData('Data', $factory);
        } catch (\Exception $exp) {
            return $this->returnError(403, 'try again');
        }
    }


    public function getAllAds()
    {
        try {
            $ads = $this->repository->getAllAds();
            foreach ($ads as $a) {
                $a->photo = $this->getPhoto('ads_photo/', $a->photo);
            }
            return $this->returnData('Data', $ads);
        } catch (\Exception $exp) {
            return $this->returnError(403, 'try again');
        }
    }

    public function getProductToHomePage()
    {
        try {
            $product = $this->repository->getProductToHomePage();
            foreach ($product as $p) {
                $p->logo = $this->getPhoto('factory_logo/', $p->logo);
                $p->photo = $this->getPhoto('product_photo/', $p->photo);
            }

            return $this->returnData('Data', $product);
        } catch (\Exception $exp) {
            return $this->returnError(403, 'try again');
        }
    }

    public function searchFactoryByName(searchFactoryName $req)
    {
        try {
            $factory = $this->repository->searchFactoryByName($req->name);
            foreach ($factory as $f) {
                $f->logo = $this->getPhoto('factory_logo/', $f->logo);
            }
            return $this->returnData('Data', $factory);
        } catch (\Exception $exp) {
            return $this->returnError(403, 'try again');
        }
    }

    public function getOfferForFactory(getOfferFactory $req)
    {
        try {
            $offer = $this->repository->getOfferForFactory($req->factory_id);
            foreach ($offer as $f) {
                $f->photo = $this->getPhoto('product_photo/', $f->photo);
            }
            return $this->returnData('Data', $offer);
        } catch (\Exception $exp) {
            return $this->returnError(403, 'try again');
        }
    }

    public function getAllCategoryForFactory(getOfferFactory $req)
    {
        try {
            $category = $this->repository->getAllCategoryForFactory($req->factory_id);
            return $this->returnData('Data', $category);
        } catch (\Exception $exp) {
            return $this->returnError(403, 'try again');
        }
    }

    public function getAllSubCategoryForFactory(getAllSubCategoryForFactory $req)
    {
        try {
            $SubCategory = $this->repository->getAllSubCategoryForFactory($req->category_id);
            return $this->returnData('Data', $SubCategory);
        } catch (\Exception $exp) {
            return $this->returnError(403, 'try again');
        }
    }

    public function getAllProductForSubCategory(getAllProductForSubCategory $req)
    {
        try {
            $products = $this->repository->getAllProductForSubCategory($req->subCategory_id);
            foreach ($products as $f) {
                $f->photo = $this->getPhoto('product_photo/', $f->photo);
            }
            return $this->returnData('Data', $products);
        } catch (\Exception $exp) {
            return $this->returnError(403, 'try again');
        }
    }


    public function createOrder(createOrder $req)
    {
        try {
            DB::beginTransaction();
            $this->repository->createOrder($req->order,$req->market_id,$req->factory_id);
            DB::commit();
            return $this->returnSuccessMessage('تم اضافة الطلب بنجاح');
        } catch (\Exception $exp) {
            DB::rollBack();
            return $this->returnError(403, 'try again');
        }
    }


    public function getWaitAcceptOrder(getHistoryOrder $req){
        try {
            $orders = $this->repository->getWaitAcceptOrder($req->market_id);
            return $this->returnData('Data', $orders);
        } catch (\Exception $exp) {
            return $this->returnError(403, 'try again');
        }
    }

    public function getRejectCompleteOrder(getHistoryOrder $req){
        try {
            $orders = $this->repository->getRejectCompleteOrder($req->market_id);
            return $this->returnData('Data', $orders);
        } catch (\Exception $exp) {
            return $this->returnError(403, 'try again');
        }
    }

}

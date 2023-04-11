<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Region;
use App\Traits\GeneralTrait;
use App\Traits\GeneralTrait2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    use GeneralTrait2, GeneralTrait;

    public function getAllRegions(){
        $regions=Region::get();
        return $this->returnData('regions',$regions,'تم الحصول على المعلومات بنجاح');
    }

    public function getRegionById(Request $request){
        $region=Region::where('id',$request->id)->first();
        if($region)
        {
            return $this->returnData('region',$region,'تم الحصول على المعلومات بنجاح');
        }
        else
        {
            return $this->returnError(404,'لم يتم إيجاد المنطقة');
        }
    }

    public function storeRegion(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3', 'max:7'],
            'city_id' => ['required'],
        ]);
        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $region = Region::create(array_merge(
            $validator->validated()
        ));
        return $this->SuccessMessage('تم إضافة المنطقة بنجاح');
    }
    public function deleteRegion(Request $request){
        $region = Region::where('id',$request->id)->first();
        if($region)
        {
            $region->delete=true;
            $region->save();
            return $this->SuccessMessage('تم حذف المنطقة بنجاح');
        }
        else
        {
            return $this->returnError(404,'لم يتم إيجاد المنطقة');
        }
    }
    public function updateRegion(Request $request){
        $region = Region::where('id',$request->id)->first();
        if($region)
        {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'min:3', 'max:50'],
                'city_id' => ['required'],

            ]);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $region->name=$request->name;
            $region->city_id=$request->city_id;
            $region->save();
            return $this->SuccessMessage('تم تعديل المنطقة بنجاح');
        }
        else
        {
            return $this->returnError(404,'لم يتم إيجاد المنطقة');

        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use App\Traits\GeneralTrait2;

class CityController extends Controller
{
    use GeneralTrait2, GeneralTrait;

    public function getAllCities(){
$cities=City::get();
return $this->returnData('cities',$cities,'تم الحصول على المعلومات بنجاح');
    }

    public function getCityById(Request $request){
$city=City::where('id',$request->id)->first();
if($city)
{
    return $this->returnData('city',$city,'تم الحصول على المعلومات بنجاح');
}
else
{
    return $this->returnError(404,'لم يتم إيجاد المدينة');
}
    }

    public function storeCity(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3', 'max:7', 'unique:cities'],
        ]);
        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $city = City::create(array_merge(
            $validator->validated()
        ));
            return $this->SuccessMessage('تم إضافة المدينة بنجاح');
    }
    public function deleteCity(Request $request){
        $city=City::where('id',$request->id)->first();
        if($city)
        {
            $city->delete=true;
            $city->save();
            return $this->SuccessMessage('تم حذف المدينة بنجاح');

        }
          else
          {
              return $this->returnError(404,'لم يتم إيجاد المدينة');

          }
    }
    public function updateCity(Request $request){
        $city=City::where('id',$request->id)->first();
if($city)
{
    $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'min:3', 'max:7', 'unique:cities'],
    ]);
    if ($validator->fails()) {
        $code = $this->returnCodeAccordingToInput($validator);
        return $this->returnValidationError($code, $validator);
    }
    $city->name=$request->name;
    $city->save();
    return $this->SuccessMessage('تم تعديل المدينة بنجاح');

}
else
{
    return $this->returnError(404,'لم يتم إيجاد المدينة');

}
    }
}

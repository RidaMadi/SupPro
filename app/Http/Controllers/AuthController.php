<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\GeneralTrait;
use App\Traits\GeneralTrait2;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    use GeneralTrait2, GeneralTrait;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'f_name' => ['required'],
            'l_name' => ['required'],
            'role' => ['required'],
            'phone'=> ['min:10','max:10', 'unique:users'],
        ]);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            [
                'password' => Hash::make($request->password),
            ]
        ));
        return $this->returnData('Data', $user, 'تم إنشاء الحساب بنجاح');//return json response

    }
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $user = User::where('email', $request->all()['email'])->first();

        // Check Password
        if (!$user || !Hash::check($request->all()['password'], $user->password)) {
            return $this->returnError(403, 'معلومات الدخول غير صالحة');

        }

        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->returnError(403, 'معلومات الدخول غير صالحة');
            }
        } catch (JWTException $e) {
            return $this->returnError(403, 'خطأ ما.. حاول لاحقا');
        }

        return $this->returnData('Data', $token, 'login successfully');//return json response

    }
    public function Logout(Request $request)
    {
        $token = $request->header('auth-token');
        if ($token) {
            try {
                JWTAuth::setToken($token)->invalidate(); //logout
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                $this->returnError(403, 'حدث خطأ ما');
            }
            return $this->returnSuccessMessage('تم تسجيل الخروج بنجاح');
        }
        else {
            $this->returnError(403, 'حدث خطأ ما');
        }

    }
}

<?php

namespace App\Http\Controllers\API\User;

use Exception;
use Responser;
use Log;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function getBrands()
    {
	Log::info('hittted');
        try {
            $brands=Brand::select('id','name','image')->get();
            $data['brands']=$brands;
            return Responser::success('Banner List', $data);
        } catch (Exception $e) {
            return Responser::failed($e->getMessage());
        }
    }
}

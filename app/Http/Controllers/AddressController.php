<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function getProvinces()
    {
        $data = json_decode(file_get_contents(public_path('data/tinh_tp.json')), true);
        if (!$data) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        return response()->json($data);
    }
    
    public function getDistricts($provinceId)
    {
        $data = json_decode(file_get_contents(public_path('data/quan_huyen.json')), true);
        $districts = array_filter($data, function ($district) use ($provinceId) {
            return $district['parent_code'] == $provinceId;
        });
        return response()->json(array_values($districts));
    }
    
    public function getWards($districtId)
    {
        $data = json_decode(file_get_contents(public_path('data/xa_phuong.json')), true);
        $wards = array_filter($data, function ($ward) use ($districtId) {
            return $ward['parent_code'] == $districtId;
        });
        return response()->json(array_values($wards));
    }
}

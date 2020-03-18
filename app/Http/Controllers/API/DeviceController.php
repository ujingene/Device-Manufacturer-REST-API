<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Smartdevice;
use Validator;
use DB;
use App\Http\Resources\DeviceResource as DeviceResource;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Smartdevice::with('manufacturer');

        //Return collection of devices as resource 
        return DeviceResource::collection($devices);
    }

    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [ 
            'manufacturer_id' => 'required|integer', 
            'description' => 'required',
        ]);
        
        if ($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()], 401);            
            }
        
        //  Allow for create a new device
        $input = $request->all(); 
        $device = Smartdevice::create($input); 
        
        //Reeturn newly created device as a resource 
        if ($device) {
            return new DeviceResource($device);
        }
    }

    public function show($id)
    {
        // Find device by serial no
        $device = Smartdevice::findOrFail($id);
        
        // Return found smart device as a resource
        return new DeviceResource($device);
    }
    
    public function update(Request $request, $id)
    {       
        $device = Smartdevice::findOrFail($id);
        $device->update($request->all());
        
        return new DeviceResource($device);
    }

    
    public function destroy($id)
    {
        header("Access-Control-Allow-Origin: *");
        // Get the smart device 
        $device = Smartdevice::findOrFail($id);
        
        //  Delete the smart device
        if ($device->delete()) {
            return redirect()->route('smart-device.index');
        }
    }
}

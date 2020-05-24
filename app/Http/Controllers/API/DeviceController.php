<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Smartdevice;
use Validator;
use DB;
use App\Http\Resources\Device as DeviceResource;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Smartdevice::with('manufacturer')->get();
        //return $devices;
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
        $this->validate($request,[
            'manufacturer_id'  => 'required',
            'description'  => 'required'
        ]);

        $updateDetails = [
            'manufacturer_id' => $request->manufacturer_id,
            'description'  => $request->description,
            'updated_at'    => now()
        ];

        DB::table('smartdevices')
            ->where('id', $id)
            ->update($updateDetails);

        $device = Smartdevice::findOrFail($id);
        
        return new DeviceResource($device);
    }

    
    public function destroy($id)
    {
        // Get the smart device 
        $device = Smartdevice::findOrFail($id);
        
        //  Delete the smart device
        if ($device) {
            Smartdevice::destroy($id);
            $devices = Smartdevice::with('manufacturer')->get();
        
            return DeviceResource::collection($devices);
        }
        else {
            return $this->error('Device not found');
            return new DeviceResource($device);

        }
    }
}

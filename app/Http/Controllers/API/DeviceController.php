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
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");

        //get all devices
        $devices = DB::table('smartdevices')
            ->leftJoin('manufacturers', 'smartdevices.manufacturer_id', '=', 'manufacturers.id')
            ->select('smartdevices.id as id', 'smartdevices.manufacturer_id as manufacturer_id', 
            'smartdevices.description as description', 'smartdevices.updated_at as updated_at', 
            'smartdevices.created_at as created_at','manufacturers.name as manufacturer')
            ->orderby('smartdevices.manufacturer_id', 'desc')
            ->get();
        ///$devices = Smartdevice::paginate(6);

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

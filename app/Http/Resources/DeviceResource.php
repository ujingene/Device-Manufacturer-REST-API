<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
        'serial' => $this->id,
        'manufacturer_id' => $this->manufacturer_id,
        'manufacturer' => $this->manufacturer,
        'description' => $this->description,
        'created_at' => (string) $this->created_at,
        'updated_at' => (string) $this->updated_at,
      ];
    }
}

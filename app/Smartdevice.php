<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Smartdevice extends Model
{
    
    /* 
        When using the primary() method on our migrations, Laravel will notice it's an auto-incrementing 
        column and whip it up for us. 
        But, since we switched over to using UUIDs, we'll need to create the ID ourselves.
    */
    protected $fillable = ['manufacturer_id', 'description']; 

    public function manufacurer(){
        return $this->belongsTo('App\Manufacturer');
    }

    protected static function boot()
    {
        //listen for any Eloquent events using boot() function 
        parent::boot();

        static::creating(function ($smartdevice) {
            $smartdevice->{$smartdevice->getKeyName()} = (string) Str::uuid();
        });
    }

    /*
        The getIncrementing method is used here to now if the IDs on the table are incrementing. 
        Since am using UUIDs we set auto incrementing to false
    */
    public function getIncrementing()
    {
        return false;
    }

    //the getKeyType method just specifies that the IDs on the table should be stored as strings
    public function getKeyType()
    {
        return 'string';
    }
}

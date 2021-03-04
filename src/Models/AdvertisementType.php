<?php

namespace Aoeng\Laravel\Admin\Advertisement\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementType extends Model
{
    use HasFactory, DefaultDatetimeFormat;

    protected $guarded = [];

    public function advertisements()
    {
        return $this->belongsToMany(Advertisement::class, 'advertisement_type_map', 'advertisement_type_id', 'advertisement_id');
    }
}

<?php

namespace Aoeng\Laravel\Admin\Advertisement\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory, DefaultDatetimeFormat;

    protected $guarded = [];
    protected $appends = ['type_name'];

    const TYPE_APP_IN = 1;
    const TYPE_H5_URL = 2;

    public static $typeMap = [
        self::TYPE_APP_IN => 'APP内转跳',
        self::TYPE_H5_URL => '转跳网址',
    ];

    public function types()
    {
        return $this->belongsToMany(AdvertisementType::class, 'advertisement_type_map', 'advertisement_id', 'advertisement_type_id');
    }

    public function getTypeNameAttribute()
    {
        return self::$typeMap[$this->type] ?? '未知';
    }


}

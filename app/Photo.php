<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Photo extends Model implements HasMediaConversions
{
    use HasMediaTrait;

    protected static function boot()
		{
		    parent::boot();

		    // Order by name ASC
		    static::addGlobalScope('ordered', function (Builder $builder) {
		        $builder->orderBy('order_index', 'asc');
		    });
		}


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'exif' => 'array',
        'iptc' => 'array',
    ];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('small')
            ->width(300)
            ->quality(75)
            ->optimize()
            ->nonQueued();

        $this->addMediaConversion('medium')
            ->width(600)
            ->optimize()
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(1800)
            ->optimize()
            ->nonQueued();
    }
}

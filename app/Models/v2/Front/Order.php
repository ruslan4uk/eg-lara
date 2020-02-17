<?php

namespace App\Models\v2\Front;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tour() {
        return $this->belongsTo('App\Tour', 'tour_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guide() {
        return $this->belongsTo('App\User', 'guide_id', 'id');
    }

}

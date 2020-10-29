<?php

namespace App\Models;

use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Classify extends Model
{
    use ModelTree;
    protected $table = 'p_category';
    public $timestamps = false;
    protected $primaryKey = 'cat_id';
    protected $guarded = [];   //黑名单  create只需要开启

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setParentColumn('parent_id');
        $this->setOrderColumn('sort_order');
        $this->setTitleColumn('cat_name');
    }

}

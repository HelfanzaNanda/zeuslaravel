<?php

namespace Zeus\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meta extends Model
{
    use SoftDeletes;

    protected $table = 'zeus_meta';
    protected $fillable = ['meta_group', 'meta_key', 'meta_value'];
}

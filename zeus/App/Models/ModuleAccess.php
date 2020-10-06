<?php

namespace Zeus\App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleAccess extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zeus_module_access';
    public $timestamps = false;
}

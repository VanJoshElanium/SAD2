<?php

namespace App;

use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use Searchable;
    use Sortable;

    protected $primaryKey = 'supplier_id';

    protected $fillable = [
        'supplier_name', 'supplier_addr', 'supplier_email', 'supplier_cnum', 'supplier_status',
    ];

    public $sortable = ['supplier_id', 'suuplier_name', 'supplier_addr'];

    protected $hidden = [
        'remember_token',
    ];

    /* MUTATORS */
    public function setSupplierNameAttribute($value){
        $this->attributes['supplier_name'] = ucfirst($value);
    }

    public function setSupplierAddrAttribute($value){
        $this->attributes['supplier_addr'] = ucfirst($value);
    }

    /* ACCESSORS */

    /* OTHERS */
    public function searchableAs()
    {
        return 'suppliers_index';
    }

    public function supplies()
    {
        return $this->hasMany('App\Supply');
    }
}

<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model; 

class Daily extends Model {

    // table of bank
    protected $table = "account_dailies";
    protected $fillable = [
        'date', 'value', 'tree_id', 'user_id', 'notes', 'store_id', 'bank_id', 'type'
    ];
    protected $appends = ['can_delete', 'tree'];

    public function getCanDeleteAttribute() {
        return true;
    }

    public function getTreeAttribute() {
        return Tree::where('id', $this->tree_id)->first();
    }
    
    public function user() {
        return $this->belongsTo(\App\User::class, "user_id");
    }
    
    public function tree() {
        return $this->belongsTo(Tree::class, "tree_id");
    }
    
    public function bank() {
        return $this->belongsTo(Bank::class, "bank_id");
    }
    
    public function store() {
        return $this->belongsTo(Store::class, "store_id");
    }

}

<?php

namespace App\Models;

use CodeIgniter\Model;

class UserItemModel extends Model
{
    protected $table            = 'userItems';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'buyer_id',
        'product_id',
        'name',
        'price',
        'items_name',
        'qty',
        'status'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}

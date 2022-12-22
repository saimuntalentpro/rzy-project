<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class RzyNotifierQueue extends Model
{
    //use AuditableTrait;
    // use SoftDeletes;
    /**
     * @var string
     */
    // protected $table = 'rzy_notifier_queue';
    // public $timestamps = false;
    // protected $with = ['tenant', 'landlord'];

    // protected $dates = [
    //     'sent_date_time'
    // ];

    /**
     * @var array
     */
    // protected $fillable = [
    //     'purpose_code',
    //     'purpose_details',
    //     'message',
    //     'purpose_tbl',
    //     'purpose_tbl_id',
    //     'property_id',
    //     'landlord_id',
    //     'tenant_id',
    //     'created',
    //     'status',
    //     'notifier_type'
    // ];

    /**
     * @var array
     */
    // protected $casts = [];

    // public function tenant()
    // {
    //     return $this->belongsTo(Customer::class, 'tenant_id');
    // }

    // public function landlord()
    // {
    //     return $this->belongsTo(Customer::class, 'landlord_id');
    // }

    // public function resolveRouteBinding($value, $field = null)
    // {
    //     return $this->where($field ?? 'id', $value)->firstOrFail();
    // }

    // public function customer()
    // {
    //     return $this->belongsTo(Customer::class, 'user_id');
    // }

    // public function scopeFilter($query, array $filters)
    // {
    //     $query->when($filters['search'] ?? null, function ($query, $search) {
    //         $search = make_keyword($search);
    //         $query->where(function ($query) use ($search) {
    //             $query->where('purpose_code', 'like', '%' . $search . '%')
    //                 ->orWhere('purpose_details', 'like', '%' . $search . '%')
    //                 ->orWhere('message', 'like', '%' . $search . '%');
    //         });
    //     });
    // }

    // Sorting
    // public function scopeSort($query)
    // {
    //     $request = Request();
    //     if ($request->has('_sort') && $request->has('_order')) {
    //         $column = $request->input('_sort');
    //         $columns = explode(".", $column);
    //         if (count($columns) === 1) {
    //             $query->orderBy($column, $request->input('_order'));
    //         } elseif (count($columns) === 2) {
    //             $query->withAggregate($columns[0], $columns[1])->orderBy(implode("_", $columns), $request->input('_order'));
    //         } else {
    //             $query->latest('id');
    //         }
    //     } else {
    //         $query->latest('id');
    //     }
    // }
}

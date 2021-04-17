<?php

namespace App\Models;

use App\DynamicTable\InterfaceClass\DynamicTableInterface;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enquiry extends Model implements DynamicTableInterface
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'vendor_id',
        'product_id',
        'status',
        'description',
    ];
    protected $casts=[
        'created_at'=>'datetime'
    ];
    protected $hidden=[
        'updated_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function getStatusTextAttribute(){
        return ['Disabled','Pending','Delivered'][$this->status];
    }

    public static function  dynamicTableColumns(){
        return [
            "Enquired Date",
            'Customer Name',
            'Customer Contact',
            'Vendor Company Name',
            'Product',
            'Message',
            'Status',
            'Action',
        ];
    }

    public function dynamicTableData()
    {
        if($this->status==2)
        $status='<a href="'.route('admin.enquiries.status',[$this->id]).'">
            <span class="badge badge-success">Delivered</span>
        </a>';
        elseif($this->status==1)
        $status='<a href="'.route('admin.enquiries.status',[$this->id]).'">
            <span class="badge badge-primary">Pending</span>
        </a>';
        else
        $status='<a href="'.route('admin.enquiries.status',[$this->id]).'">
            <span class="badge badge-secondary">Disabled</span>
        </a>';
        return [
            $this->created_at->format('d/m/Y h:i A'),
            $this->user->name,
            $this->user->mobile_number,
            $this->product->vendor->shop_name,
            $this->product->name,
            $this->description,
            ['html', $status],
            ['html', '<a href="'.route('admin.enquiries.edit',[$this->id]).'"><i class="icon-view fas fa-edit"></i></a>'],
          //  ['html', '<a href="'.url("admin/sales",[$this->id]).'" class="btn btn-info"><i class="fa fa-eye"></i></a>'],
        ];
    }
}

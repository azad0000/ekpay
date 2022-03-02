<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const TRNX_CURRENCY_RADIO = [
        'BDT' => 'BDT',
        'USD' => 'USD',
    ];

    public $table = 'transactions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'cust_id_no',
        'cust_name',
        'cust_mobo_no',
        'cust_email',
        'cust_mail_addr',
        'merchant_trnx_id_no',
        'merchant_trnx_amt',
        'trnx_currency',
        'merchant_ord_id_no',
        'merchant_ord_det',
        'company_id',
        'created_at',
        'payment_url',
        'secure_token',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public static function boot()
    {
        parent::boot();
        Transaction::observe(new \App\Observers\TransactionActionObserver());
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ipn extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const IS_SETTLED_RADIO = [
        '0' => 'Not Settled',
        '1' => 'Settled',
    ];

    public $table = 'ipns';

    protected $dates = [
        'created_at',
        'req_timestamp',
        'pay_timestamp',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'txn_id_no_id',
        'created_at',
        'msg_code',
        'msg_det',
        'req_timestamp',
        'dgtl_sign',
        'remarks',
        'ekpay_txn_id_no',
        'pi_trnx_id_no',
        'pi_charge',
        'ekpay_charge',
        'pi_discount',
        'total_ser_charge',
        'ekpay_charge_discount',
        'promo_discount',
        'total_pabl_amt',
        'pay_timestamp',
        'pi_name',
        'pi_type',
        'pi_number',
        'pi_gateway',
        'is_settled',
        'settlement',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public static function boot()
    {
        parent::boot();
        Ipn::observe(new \App\Observers\IpnActionObserver());
    }

    public function txn_id_no()
    {
        return $this->belongsTo(Transaction::class, 'txn_id_no_id');
    }

    public function getReqTimestampAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setReqTimestampAttribute($value)
    {
        $this->attributes['req_timestamp'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getPayTimestampAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setPayTimestampAttribute($value)
    {
        $this->attributes['pay_timestamp'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
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

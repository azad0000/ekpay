<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class General extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const IPN_CHANNEL_SELECT = [
        '0' => 'None',
        '1' => 'Both',
        '2' => 'Only through email',
        '3' => 'Through API',
    ];

    public $table = 'generals';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'mer_reg_id_no',
        'mer_pas_key',
        'ekpay_dev_uri',
        'ekpay_prod_uri',
        'test_mode',
        's_uri',
        'f_uri',
        'c_uri',
        'ipn_uri',
        'mac_addr',
        'ipn_channel',
        'ipn_email',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

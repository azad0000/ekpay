<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const IPN_CHANNEL_SELECT = [
        '0' => 'None',
        '1' => 'Both',
        '2' => 'Only through email',
        '3' => 'Through API',
    ];

    public $table = 'companies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'shortname',
        'mer_reg',
        'mer_pas_key',
        'domain_url',
        's_uri',
        'f_uri',
        'c_uri',
        'ipn_channel',
        'ipn_email',
        'ipn_uri',
        'mac_addr',
        'active',
        'created_at',
        'has_ekpay_id_no',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public static function boot()
    {
        parent::boot();
        Company::observe(new \App\Observers\CompanyActionObserver());
    }

    public function companyUsers()
    {
        return $this->hasMany(User::class, 'company_id', 'id');
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

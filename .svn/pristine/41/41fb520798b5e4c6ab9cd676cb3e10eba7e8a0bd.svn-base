<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Jenkins_credential extends Model
{
    use SoftDeletes;

    public $table = 'jenkins_credentials';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'server_name_ip',
        'jenkins_user',
        'jenkins_token',
        'note'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'server_name_ip' => 'string',
        'jenkins_user' => 'string',
        'jenkins_token' => 'string',
        'note' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'server_name_ip' => 'required',
        'jenkins_user' => 'required',
        'jenkins_token' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function instanceDetails()
    {
        return $this->hasMany(\App\Models\InstanceDetail::class, 'jenkins_credentials_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function jenkinsJobs()
    {
        return $this->hasMany(\App\Models\JenkinsJob::class, 'jenkins_credentials_id');
    }

    public function getJenkinsTokenAttribute($value)
    {
        try {
            return \Crypt::decrypt($value);
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function setJenkinsTokenAttribute($value)
    {
        $this->attributes['jenkins_token'] = \Crypt::encrypt($value);
    }
}

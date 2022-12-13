<?php

namespace App\Repositories;

use App\Models\Jenkins_credential;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Jenkins_credentialRepository
 * @package App\Repositories
 * @version September 16, 2022, 2:23 pm IST
 */

class Jenkins_credentialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'server_name_ip',
        'jenkins_user',
        'jenkins_token',
        'note'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Jenkins_credential::class;
    }
}

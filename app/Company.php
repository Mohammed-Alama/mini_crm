<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method public employee()
 * @property mixed id
 * @property mixed name
 * @property mixed website
 * @property mixed logo
 */
class Company extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employee()
    {
        return $this->hasMany(Employee::class,'company_id');
    }
}

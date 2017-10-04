<?php

namespace App\API\v1\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Person extends Model
{
    use SearchableTrait;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'persons';

    /**
    * The primary key for the model.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
    * Searchable rules.
    *
    * @var array
    */
    protected $searchable = [
        /**
        * Columns and their priority in search results.
        * Columns with higher values are more important.
        * Columns with equal values have equal importance.
        *
        * @var array
        */
        'columns' => [
            'name' => 10,
            'first_name' => 10,
            'last_name' => 5
        ]
    ];


    /**
     * Get the full name.
     *
     * @param  string  $value
     * @return string
     */
    public function getFullNameAttribute($value)
    {
        return "{$this->name} {$this->first_name} {$this->last_name}";
    }
}

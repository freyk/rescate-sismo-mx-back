<?php

namespace App\API\v1\Transformers;

use App\API\v1\Models\Person;
use League\Fractal;

class PersonItemTransformer extends Fractal\TransformerAbstract
{
    public function transform(Person $person)
    {
        return [
            'id'              => (int) $person->id,
            'name'            => $person->name,
            'first_name'      => $person->first_name,
            'last_name'       => $person->last_name,
            'created_date'    => formatDateToISO8601($person->created_at),
            'updated_date'    => formatDateToISO8601($person->updated_at)
        ];
    }
}

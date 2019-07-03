<?php
namespace AR;

class Author extends Model
{
    public static function getMapping():array
    {
        return [
            'table_name'=>'author',
            'columns'=>[
                'id'=>'integer',
                'last_name'=>'string',
                'first_name'=>'string',
                'birth_date'=>'date',
                'death_date'=>'date',
            ]
        ];
    }

    public function __toString()
    {
        return $this->get('first_name') . ' ' . $this->get('last_name');
    }
}
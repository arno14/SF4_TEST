<?php
namespace AR;

class Book extends Model
{
    public static function getMapping():array
    {
        return [
            'table_name'=>'book',
            'columns'=>[
                'id'=>'integer',
                'title'=>'string',
                'isbn'=>'date',
                'publication_date'=>'date',
                'author_id'=>'integer',
            ],
            'has_one'=>[
                'author'=>[
                    'class_name'=>Author::class,
                    'local_key'=>'author_id',
                    'foreign_key'=>'id'
                ]
            ]
        ];
    }

    public function __toString()
    {
        return $this->get('title');
    }
}
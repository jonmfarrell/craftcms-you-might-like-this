<?php
namespace Craft;

class MightLikeRecord extends BaseRecord
{
    /**
    * Get table name
    *
      * @return string
    */
    public function getTableName()
    {
        return 'mightlike';
    }

    /**
    * Define table columns
    *
      * @return array
    */
    public function defineAttributes()
    {
        return array(
            'relatedProduct' => array(AttributeType::String, 'default' => ''),
            'count' => array(AttributeType::Number, 'default' => 0)
        );
    }

    /**
    * Define relationships with other tables
    *
      * @return array
    */
    public function defineRelations()
    {
        return array(
            'product' => array(static::BELONGS_TO, 'Commerce_ProductRecord', 'required' => true, 'onDelete' => static::CASCADE)
        );
    }

    /**
    * Define table indexes
    *
      * @return array
    */
    public function defineIndexes()
    {
        return array(
            array('columns' => array('productId'))
        );
    }
}

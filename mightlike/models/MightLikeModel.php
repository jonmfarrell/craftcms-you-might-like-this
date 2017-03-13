<?php
namespace Craft;

class MightLikeModel extends BaseModel
{
  /**
  * Define model attributes
  *
    * @return array
  */
  public function defineAttributes()
  {
    return array(
      'id' => AttributeType::Number,
      'count' => array(AttributeType::Number, 'default' => 0),
      'relatedProduct' => array(AttributeType::String, 'default' => '')
    );
  }
}

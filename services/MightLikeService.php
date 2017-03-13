<?php
namespace Craft;

class MightLikeService extends BaseApplicationComponent
{
  /**
  * Returns products that you might also like
  *
    * @param int $productId
    * @return EntryCountModel
  */
  public function getRelatedProductsByCount($productId)
  {
    $mightLikeRecords =  craft()->db->createCommand()->select('*')->from('mightlike')->where(array('productId'=>$productId))->order('count desc')->queryAll();
    $productIds = array();
    foreach ($mightLikeRecords as $mightLikeRecord)
    {
        $productIds[] = $mightLikeRecord['relatedProduct'];
    }
    $criteria = craft()->elements->getCriteria('Commerce_Product');
    $criteria->id = $productIds;
    $criteria->fixedOrder = true;
    return $criteria;
  }

  /**
   * Increments the count of a given product and related product
     * @param  int $productId
     * @param  int $relatedProductId
   */
  public function incrementCount($productId, $relatedProductId)
  {
    $mightLikeRecord = MightLikeRecord::model()->findByAttributes(array('productId' => $productId));
    if ($mightLikeRecord)
    {
      $mightLikeRecords = MightLikeRecord::model()->findByAttributes(array('productId' => $productId, 'relatedProduct'=>$relatedProductId));
      if($mightLikeRecords)
      {
        $mightLikeRecords->setAttribute('count', $mightLikeRecord->getAttribute('count') + 1);
      }
      else
      {
        $mightLikeRecords = new MightLikeRecord;
        $mightLikeRecords->setAttribute('productId', $productId);
        $mightLikeRecords->setAttribute('relatedProduct', $relatedProductId);
        $mightLikeRecords->setAttribute('count', 1);
      }
    }
    else
    {
        $mightLikeRecords = new MightLikeRecord;
        $mightLikeRecords->setAttribute('productId', $productId);
        $mightLikeRecords->setAttribute('relatedProduct', $relatedProductId);
        $mightLikeRecords->setAttribute('count', 1);
    }
    $mightLikeRecords->save();
  }
}

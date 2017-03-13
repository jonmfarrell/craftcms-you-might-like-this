<?php
namespace Craft;

class MightLikeVariable
{
  /**
   * Returns count
   *
     * @param int $productId
     * @return EntryCountModel
   */
  public function getRelatedProductsByCount($productId)
  {
    return craft()->mightLike->getRelatedProductsByCount($productId);
  }
}

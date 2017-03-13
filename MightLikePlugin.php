<?php
namespace Craft;

class MightLikePlugin extends BasePlugin
{
  public function getName()
  {
    return Craft::t('You might also like...');
  }
  public function getVersion()
  {
    return '1.0.0';
  }
  public function getDeveloper()
  {
    return 'Jon Farrell';
  }
  public function getDeveloperUrl()
  {
    return 'http://www.jonfarrell.io/';
  }
  public function onBeforeInstall()
  {
    $plugin = craft()->plugins->getPlugin('commerce',false);
    if($plugin->isInstalled && $plugin->isEnabled)
    {

    }
    else
    {
      craft()->userSession->setNotice(Craft::t('You must install and enable Craft Commerce before installing this plugin'));
      return false;
    }
  }
  public function init()
  {
    parent::init();
    craft()->on('commerce_orders.onOrderComplete', function(Event $event)
    {
      foreach($event->params['order']->lineItems as $lineItem)
      {
        $productId = $lineItem->purchasable->product->id;
        foreach($event->params['order']->lineItems as $lineItem)
        {
          $relatedProductId = $lineItem->purchasable->product->id;
          if($productId != $relatedProductId)
          {
            craft()->mightLike->incrementCount($productId, $relatedProductId);
          }
        }
      }
    });
  }
}

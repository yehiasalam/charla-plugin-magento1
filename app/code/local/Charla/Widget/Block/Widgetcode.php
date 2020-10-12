<?php
class Charla_Widget_Block_Widgetcode extends Mage_Core_Block_Template
{

   public function getPropertyId(){

        $configValue = Mage::getStoreConfig(
            'charlageneral/charlasettings/property',
            Mage::app()->getStore()
        ); 

        return $configValue;

   }
 

}
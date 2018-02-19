<?php
namespace Bullseye\Locator\Model\Config\Source;
 
class Viewtype implements \Magento\Framework\Option\ArrayInterface
{

	const VIEW_LIST = 'list';
	const VIEW_MAP = 'map';

    public function toOptionArray()
    {
        return [
            ['value' => self::VIEW_LIST, 'label' => __('List View')],
            ['value' => self::VIEW_MAP, 'label' => __('Map View')]
        ];
    }
}
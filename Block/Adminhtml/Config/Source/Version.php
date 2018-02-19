<?php

namespace Bullseye\Locator\Block\Adminhtml\Config\Source;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Module\ModuleListInterface;
use Magento\Backend\Block\Template\Context;

class Version extends Field
{
    const MODULE_NAME = 'Bullseye_Locator';

    protected $_moduleList;

    public function __construct(
        Context $context,
        ModuleListInterface $moduleList)
    {
        $this->_moduleList = $moduleList;
        parent::__construct($context);
    }

    protected function _getElementHtml(AbstractElement $element)
    {

        $html = "<i style='color:red'>";
        $html .= $this->getVersion();
        $html .= "</i>";

        return $html;
    }

    public function getVersion()
    {
        return $this->_moduleList
            ->getOne(self::MODULE_NAME)['setup_version'];
    }
}
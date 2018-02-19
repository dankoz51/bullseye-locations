<?php

namespace Bullseye\Locator\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Customer\Setup\CustomerSetup;
use Magento\Eav\Setup\EavSetupFactory;


class InstallSchema implements InstallSchemaInterface
{

    private $eavSetupFactory;
    protected $_pageFactory;

    public function __construct(EavSetupFactory $eavSetupFactory, \Magento\Cms\Model\PageFactory $pageFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory; 
        $this->_pageFactory = $pageFactory;
    }

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();
		
        if (version_compare($context->getVersion(), '1.1') < 0) {
            $page = $this->_pageFactory->create();
            $page->setTitle('Bullseye StoreLocator')
                ->setIdentifier('storelocator')
                ->setIsActive(true)
                ->setPageLayout('1column')
                ->setStores(array(0))
                ->setContent('Please refer to the manual for creating a Bullseye embeddable interface and paste the js into the source view of this page in the CMS editor. Make sure to use source view (Click show hide editor) so that the code does not get converted to text')
                ->save();
        }
 

        $installer->endSetup();
    }
}

<?php

namespace Bullseye\Locator\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\Customer;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig       = $eavConfig;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'address_id',
            [
                'label' => 'Address ID',
                'system' => 0,
                'position' => 100,
                'sort_order' =>100,
                'visible' =>  true,
                'note' => '',
                'type' => 'varchar',
                'input' => 'text',
            ]
        );
        $customAttribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'address_id');

        $customAttribute->setData(
            'used_in_forms',
            ['adminhtml_customer']

        );
        $customAttribute->setData('is_required',0);
        $customAttribute->save();

        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'saved_store',
            [
                'label' => 'Saved Address',
                'system' => 0,
                'position' => 100,
                'sort_order' =>100,
                'visible' =>  true,
                'note' => '',
                'type' => 'varchar',
                'input' => 'text',
            ]
        );
        $customAttribute1 = $this->eavConfig->getAttribute(Customer::ENTITY, 'saved_store');

        $customAttribute1->setData(
            'used_in_forms',
            ['adminhtml_customer']

        );
        $customAttribute1->setData('is_required',0);
        $customAttribute1->save();


    }
}
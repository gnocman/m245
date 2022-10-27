<?php declare(strict_types=1);

namespace Magenest\DatabaseEAV\Setup\Patch\Data;

use Magenest\DatabaseEAV\Model\Config\Source\AddressClassification;
use Magento\Customer\Api\AddressMetadataInterface;
use Magento\Customer\Model\ResourceModel\Attribute as AttributeResourceModel;
use Magento\Eav\Model\Config as EavConfig;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Zend_Validate_Exception;

class AddAddressClassificationAttribute implements DataPatchInterface
{
    const ATTRIBUTE_CODE = 'address_classification';

    private AttributeResourceModel $attributeResourceModel;
    private EavConfig $eavConfig;
    private EavSetupFactory $eavSetupFactory;
    private ModuleDataSetupInterface $moduleDataSetup;

    public function __construct(
        AttributeResourceModel   $attributeResourceModel,
        EavConfig                $eavConfig,
        EavSetupFactory          $eavSetupFactory,
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->attributeResourceModel = $attributeResourceModel;
        $this->eavConfig = $eavConfig;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @return array
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * @return $this
     * @throws LocalizedException
     * @throws AlreadyExistsException
     * @throws Zend_Validate_Exception
     */
    public function apply(): self
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(
            AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
            self::ATTRIBUTE_CODE,
            [
                'type' => 'int',
                'label' => 'Address Classification',
                'input' => 'select',
                'source' => AddressClassification::class,
                'required' => true,
                'default' => 0,
                'system' => false,
                'position' => 150,
                'sort_order' => 150,
            ]
        );
        $attribute = $this->eavConfig->getAttribute(
            AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
            self::ATTRIBUTE_CODE
        );
        $attribute->setData('used_in_forms', [
            'adminhtml_customer_address',
            'customer_address_edit',
            'customer_register_address',
        ]);
        $this->attributeResourceModel->save($attribute);

        return $this;
    }
}

<?php

namespace Magenest\DatabaseEAV\Plugin;

use Magento\Catalog\Model\ProductFactory;
use Magento\Checkout\Model\Cart;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;

/**
 *
 */
class AddToCart
{
    /**
     * @var ProductFactory
     */
    private ProductFactory $productFactory;
    /**
     * @var Configurable
     */
    private Configurable $configurable;

    /**
     * @param ProductFactory $productFactory
     * @param Configurable $configurable
     */
    public function __construct(
        ProductFactory $productFactory,
        Configurable   $configurable
    ) {
        $this->productFactory = $productFactory;
        $this->configurable = $configurable;
    }

    /**
     * @param Cart $subject
     * @param $productInfo
     * @param $requestInfo
     * @return array
     */
    public function beforeAddProduct(Cart $subject, $productInfo, $requestInfo)
    {
        if ($productInfo->getTypeId() == 'configurable') {
            $product = $this->productFactory->create()->load($productInfo->getId());
            $new_product = $this->configurable->getProductByAttributes($requestInfo['super_attribute'], $product);
        } else {
            return [$productInfo, $requestInfo];
        }
        return [$new_product, $requestInfo];
    }
}

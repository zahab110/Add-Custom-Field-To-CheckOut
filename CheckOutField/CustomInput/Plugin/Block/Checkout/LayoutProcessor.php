<?php
/**
 * GiaPhuGroup Co., Ltd.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GiaPhuGroup.com license that is
 * available through the world-wide-web at this URL:
 * https://www.giaphugroup.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    PHPCuong
 * @package     PHPCuong_CustomCheckoutFields
 * @copyright   Copyright (c) 2020-2021 GiaPhuGroup Co., Ltd. All rights reserved. (http://www.giaphugroup.com/)
 * @license     https://www.giaphugroup.com/LICENSE.txt
 */

namespace CheckOutField\CustomInput\Plugin\Block\Checkout;

class LayoutProcessor
{
    /**
     * Process js Layout of block
     *
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $subject, $jsLayout)
    {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['passport_number'] = $this->processDeliveryDateAddress('shippingAddress');

        return $jsLayout;
    }

    /**
 * Process provided address.
 *
 * @param string $dataScopePrefix
 * @return array
 */
private function processDeliveryDateAddress($dataScopePrefix)
{
    return [
        'component' => 'Magento_Ui/js/form/element/abstract',
        'config' => [
            'customScope' => $dataScopePrefix . '.custom_attributes',
            'customEntry' => null,
            'template' => 'ui/form/field',
            'elementTmpl' => 'ui/form/element/input',
            'id' => 'passport_number', // Corrected: use 'passport_number' instead of 'delivery_date'
        ],
        'dataScope' => $dataScopePrefix . '.custom_attributes.passport_number',
        'label' => __('Passport Number'),
        'provider' => 'checkoutProvider',
        'validation' => [
            'required-entry' => true,
        ],
        'sortOrder' => 201,
        'visible' => true,
        'imports' => [
            'initialOptions' => 'index = checkoutProvider:dictionaries.passport_number',
            'setOptions' => 'index = checkoutProvider:dictionaries.passport_number',
        ],
    ];
}


}
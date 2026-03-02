<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\PaymentPage;

use Spryker\Yves\Kernel\AbstractFactory;
use Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface;
use SprykerShop\Yves\CheckoutPage\Form\StepEngine\ExtraOptionsSubFormInterface;
use SprykerShop\Yves\PaymentPage\Dependency\Client\PaymentPageToCartClientInterface;
use SprykerShop\Yves\PaymentPage\Dependency\Client\PaymentPageToCustomerClientInterface;
use SprykerShop\Yves\PaymentPage\Dependency\Client\PaymentPageToSalesClientInterface;
use SprykerShop\Yves\PaymentPage\Form\DataProvider\PaymentForeignFormDataProvider;
use SprykerShop\Yves\PaymentPage\Form\PaymentForeignSubForm;
use SprykerShop\Yves\PaymentPage\Plugin\StepEngine\AbstractPaymentForeignSubFormPlugin;
use SprykerShop\Yves\PaymentPage\Plugin\StepEngine\PaymentForeignSubFormPlugin;

class PaymentPageFactory extends AbstractFactory
{
    public function createPaymentForeignSubFormPlugin(): AbstractPaymentForeignSubFormPlugin
    {
        return new PaymentForeignSubFormPlugin();
    }

    public function createPaymentForeignSubForm(): ExtraOptionsSubFormInterface
    {
        return new PaymentForeignSubForm();
    }

    public function createPaymentForeignFormDataProvider(): StepEngineFormDataProviderInterface
    {
        return new PaymentForeignFormDataProvider();
    }

    public function getCartClient(): PaymentPageToCartClientInterface
    {
        return $this->getProvidedDependency(PaymentPageDependencyProvider::CLIENT_CART);
    }

    public function getCustomerClient(): PaymentPageToCustomerClientInterface
    {
        return $this->getProvidedDependency(PaymentPageDependencyProvider::CLIENT_CUSTOMER);
    }

    public function getSalesClient(): PaymentPageToSalesClientInterface
    {
        return $this->getProvidedDependency(PaymentPageDependencyProvider::CLIENT_SALES);
    }
}

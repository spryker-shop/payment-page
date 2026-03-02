<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\PaymentPage;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\PaymentPage\Dependency\Client\PaymentPageToCartClientBridge;
use SprykerShop\Yves\PaymentPage\Dependency\Client\PaymentPageToCustomerClientBridge;
use SprykerShop\Yves\PaymentPage\Dependency\Client\PaymentPageToSalesClientBridge;

/**
 * @method \SprykerShop\Yves\CheckoutPage\CheckoutPageConfig getConfig()
 */
class PaymentPageDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_CART = 'CLIENT_CART';

    /**
     * @var string
     */
    public const CLIENT_CUSTOMER = 'CLIENT_CUSTOMER';

    /**
     * @var string
     */
    public const CLIENT_SALES = 'CLIENT_SALES';

    public function provideDependencies(Container $container): Container
    {
        $container = $this->addCartClient($container);
        $container = $this->addCustomerClient($container);
        $container = $this->addSalesClient($container);

        return $container;
    }

    protected function addCartClient(Container $container): Container
    {
        $container->set(static::CLIENT_CART, function (Container $container) {
            return new PaymentPageToCartClientBridge($container->getLocator()->cart()->client());
        });

        return $container;
    }

    protected function addCustomerClient(Container $container): Container
    {
        $container->set(static::CLIENT_CUSTOMER, function (Container $container) {
            return new PaymentPageToCustomerClientBridge($container->getLocator()->customer()->client());
        });

        return $container;
    }

    protected function addSalesClient(Container $container): Container
    {
        $container->set(static::CLIENT_SALES, function (Container $container) {
            return new PaymentPageToSalesClientBridge($container->getLocator()->sales()->client());
        });

        return $container;
    }
}

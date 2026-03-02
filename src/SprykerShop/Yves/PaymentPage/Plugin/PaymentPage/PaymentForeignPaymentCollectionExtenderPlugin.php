<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\PaymentPage\Plugin\PaymentPage;

use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Spryker\Yves\Kernel\AbstractPlugin;
use Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection;
use SprykerShop\Yves\CheckoutPageExtension\Dependency\Plugin\PaymentCollectionExtenderPluginInterface;

/**
 * @method \SprykerShop\Yves\PaymentPage\PaymentPageFactory getFactory()
 */
class PaymentForeignPaymentCollectionExtenderPlugin extends AbstractPlugin implements PaymentCollectionExtenderPluginInterface
{
    public function extendCollection(
        SubFormPluginCollection $paymentSubFormPluginCollection,
        PaymentMethodsTransfer $paymentMethodsTransfer
    ): SubFormPluginCollection {
        foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
            if (!$paymentMethodTransfer->getPaymentAuthorizationEndpoint()) {
                continue;
            }

            $paymentSubFormPluginCollection = $this->addPaymentForeignMethod(
                $paymentSubFormPluginCollection,
                $paymentMethodTransfer,
            );
        }

        return $paymentSubFormPluginCollection;
    }

    protected function addPaymentForeignMethod(
        SubFormPluginCollection $paymentSubFormPluginCollection,
        PaymentMethodTransfer $paymentMethodTransfer
    ): SubFormPluginCollection {
        $paymentForeignSubFormPlugin = $this->getFactory()
            ->createPaymentForeignSubFormPlugin()
            ->setPaymentMethodTransfer($paymentMethodTransfer);

        return $paymentSubFormPluginCollection->add($paymentForeignSubFormPlugin);
    }
}

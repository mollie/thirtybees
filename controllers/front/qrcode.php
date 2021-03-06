<?php

/**
 * Class MollieQrcodeModuleFrontController
 *
 * @property Mollie $module
 */
class MollieQrcodeModuleFrontController extends ModuleFrontController
{
    const PENDING = 1;
    const SUCCESS = 2;
    const REFRESH = 3;

    /** @var bool $ssl */
    public $ssl = true;
    /** @var bool If false, does not build left page column content and hides it. */
    public $display_column_left = false;
    /** @var bool If false, does not build right page column content and hides it. */
    public $display_column_right = false;

    /**
     * @throws Adapter_Exception
     * @throws PrestaShopDatabaseException
     * @throws PrestaShopException
     * @throws SmartyException
     */
    public function initContent()
    {
        if (Tools::getValue('ajax')) {
            $this->processAjax();
            exit;
        }

        if (Tools::getValue('done')) {
            $canceled = true;
            $dbPayment = $this->module->getPaymentBy('cart_id', Tools::getValue('cart_id'));
            if (is_array($dbPayment)) {
                try {
                    $apiPayment = $this->module->api->payments->get($dbPayment['transaction_id']);
                    $canceled = $apiPayment->status !== \Mollie\Api\Types\PaymentStatus::STATUS_PAID;
                } catch (\Mollie\Api\Exceptions\ApiException $e) {
                }
            }

            header('Content-Type: text/html');
            $this->context->smarty->assign(array(
                'ideal_logo' => __PS_BASE_URI__.'modules/mollie/views/img/ideal_logo.png',
                'canceled'   => $canceled,
            ));
            echo $this->context->smarty->fetch(_PS_MODULE_DIR_.'mollie/views/templates/front/qr_done.tpl');
            exit;
        }
    }

    /**
     * @throws Adapter_Exception
     * @throws PrestaShopDatabaseException
     * @throws PrestaShopException
     */
    protected function processAjax()
    {
        switch (Tools::getValue('action')) {
            case 'qrCodeNew':
                return $this->processNewQrCode();
            case 'qrCodeStatus':
                return $this->processGetStatus();
            case 'cartAmount':
                return $this->processCartAmount();
        }

        exit;
    }

    /**
     * @throws Adapter_Exception
     * @throws PrestaShopDatabaseException
     * @throws PrestaShopException
     */
    protected function processNewQrCode()
    {
        header('Content-Type: application/json;charset=UTF-8');
        @ob_clean();
        /** @var Mollie $mollie */
        $mollie = Module::getInstanceByName('mollie');
        $context = Context::getContext();
        $customer = $context->customer;
        $cart = $context->cart;
        if (!$cart instanceof Cart || !$cart->getOrderTotal(true)) {
            die(json_encode(array(
                'success' => false,
                'message' => 'No active cart',
            )));
        }

        $orderTotal = $cart->getOrderTotal(true);
        $payment = $mollie->api->payments->create(Mollie::getPaymentData(
            $orderTotal,
            strtoupper($this->context->currency->iso_code),
            'ideal',
            null,
            (int) $cart->id,
            $customer->secure_key,
            $qrCode = true
        ), array(
            'include' => 'details.qrCode',
        ));
        Db::getInstance()->insert(
            'mollie_payments',
            array(
                'cart_id'        => (int) $cart->id,
                'method'         => $payment->method,
                'transaction_id' => $payment->id,
                'bank_status'    => \Mollie\Api\Types\PaymentStatus::STATUS_OPEN,
                'created_at'     => date('Y-m-d H:i:s'),
            )
        );

        $src = isset($payment->details->qrCode->src) ? $payment->details->qrCode->src : null;
        die(json_encode(array(
            'success'       => (bool) $src,
            'href'          => $src,
            'idTransaction' => $payment->id,
            'expires'       => strtotime($payment->expiresAt) * 1000,
            'amount'        => (int) ($orderTotal * 100),
        )));
    }

    /**
     * Get payment status, can be regularly polled
     *
     * @throws PrestaShopException
     */
    protected function processGetStatus()
    {
        header('Content-Type: application/json;charset=UTF-8');
        @ob_clean();
        if (empty($this->context->cart)) {
            die(json_encode(array(
                'success' => false,
                'status'  => false,
                'amount'  => null,
            )));
        }

        try {
            $payment = $this->module->getPaymentBy('transaction_id', Tools::getValue('transaction_id'));
        } catch (PrestaShopDatabaseException $e) {
            die(json_encode(array(
                'success' => false,
                'status'  => false,
                'amount'  => null,
            )));
        } catch (PrestaShopException $e) {
            die(json_encode(array(
                'success' => false,
                'status'  => false,
                'amount'  => null,
            )));
        }

        switch ($payment['bank_status']) {
            case  \Mollie\Api\Types\PaymentStatus::STATUS_PAID:
                $status = static::SUCCESS;
                break;
            case  \Mollie\Api\Types\PaymentStatus::STATUS_OPEN:
                $status = static::PENDING;
                break;
            default:
                $status = static::REFRESH;
                break;
        }

        $cart = new Cart($payment['cart_id']);
        $amount = (int) ($cart->getOrderTotal(true) * 100);
        die(json_encode(array(
            'success' => true,
            'status'  => $status,
            'amount'  => $amount,
            'href'    => $this->context->link->getPageLink(
                'order-confirmation',
                true,
                null,
                array(
                    'id_cart'   => (int) $cart->id,
                    'id_module' => (int) $this->module->id,
                    'id_order'  => (int) Order::getOrderByCartId($cart->id),
                    'key'       => $cart->secure_key,
                )
            )
        )));
    }

    /**
     * Get the cart amount
     */
    protected function processCartAmount()
    {
        header('Content-Type: application/json;charset=UTF-8');
        @ob_clean();
        /** @var Context $context */
        $context = Context::getContext();
        /** @var Cart $cart */
        $cart = $context->cart;
        if (!$cart) {
            die(json_encode(array(
                'success' => true,
                'amount'  => 0
            )));
        }

        $cartTotal = (int) ($cart->getOrderTotal(true) * 100);
        die(json_encode(array(
            'success' => true,
            'amount'  => $cartTotal,
        )));
    }
}

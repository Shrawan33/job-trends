<?php
namespace Perception\Libraries\Payment;

use Perception\Libraries\Payment\Gateways\CCAvenueGateway;
use Perception\Libraries\Payment\Gateways\PaymentGatewayInterface;

class Payment
{
    protected $gateway;

    /**
     * @param PaymentGatewayInterface $gateway
     */
    public function __construct(PaymentGatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    public function purchase($parameters = [])
    {
        return $this->gateway->request($parameters)->send();
    }

    public function response($request)
    {
        return $this->gateway->response($request);
    }

    public function paynow($parameters)
    {
        $prepare = $this->prepare($parameters);
        $process = $this->process($prepare);
        return $process;
    }

    public function prepare($parameters = [])
    {
        return $this->gateway->request($parameters);
    }

    public function process($order)
    {
        return $order->send();
    }

    public function gateway($name)
    {
        switch ($name) {
            case 'CCAvenue':
                $this->gateway = new CCAvenueGateway();
                break;
        }

        return $this;
    }

    public function getOrderDetails($parameters)
    {
        return $this->gateway->getOrderDetails($parameters);
    }
}

<?php
namespace Perception\Libraries\Payment\Gateways;

interface PaymentGatewayInterface
{
    public function request($parameters);

    public function send();

    public function response($request);

    public function getOrderDetails($parameters);
}

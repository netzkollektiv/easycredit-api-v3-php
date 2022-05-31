<?php
namespace Teambank\RatenkaufByEasyCreditApiV3\Integration;

use Teambank\RatenkaufByEasyCreditApiV3\Model\TransactionInitRequest;

interface CheckoutInterface {

    public function getRedirectUrl();
    public function start(TransactionInitRequest $request);
    public function getConfig();
    public function isInitialized();
    public function loadTransaction();
    public function authorize($orderId = null);
    public function verifyAddress(TransactionInitRequest $request, $preCheck);
    public function isAmountValid(TransactionInitRequest $request);
    public function clear();
}

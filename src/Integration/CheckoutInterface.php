<?php
namespace Teambank\RatenkaufByEasyCreditApiV3\Integration;

use Teambank\RatenkaufByEasyCreditApiV3\Model\Transaction;

interface CheckoutInterface {

    public function getRedirectUrl();
    /**
     * @param \Teambank\RatenkaufByEasyCreditApiV3\Model\Transaction $request
     */
    public function start($request);
    public function getConfig();
    public function isInitialized();
    public function loadTransaction();
    public function authorize($orderId = null);
    /**
     * @param \Teambank\RatenkaufByEasyCreditApiV3\Model\Transaction $request
     */
    public function verifyAddress($request, $preCheck);
    /**
     * @param \Teambank\RatenkaufByEasyCreditApiV3\Model\Transaction $request
     */
    public function isAmountValid($request);
    public function clear();
}

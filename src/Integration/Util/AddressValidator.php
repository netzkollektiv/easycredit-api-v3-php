<?php
namespace Teambank\RatenkaufByEasyCreditApiV3\Integration\Util;

use Teambank\RatenkaufByEasyCreditApiV3\Model\TransactionInitRequest;
use Teambank\RatenkaufByEasyCreditApiV3\Model\Address;
use Teambank\RatenkaufByEasyCreditApiV3\Model\ShippingAddress;
use Teambank\RatenkaufByEasyCreditApiV3\Integration\ValidationException;
use Teambank\RatenkaufByEasyCreditApiV3\Integration\AddressValidationException;

class AddressValidator {

    /**
				 * @param \Teambank\RatenkaufByEasyCreditApiV3\Model\TransactionInitRequest $request
				 */
				protected function isCustomerSameAsBilling($request) {
        if (!$request->getCustomerRelationship()->getOrderDoneWithLogin()) {
            return true;
        }

        if (
            trim($request->getCustomer()->getFirstName()) != trim($request->getOrderDetails()->getInvoiceAddress()->getFirstName()) ||
            trim($request->getCustomer()->getLastName()) != trim($request->getOrderDetails()->getInvoiceAddress()->getLastName())
        ) {
            return false;
        }
        return true;
    }

    public function hashAddress($address) {
        return sha1(json_encode(
            get_object_vars($address)
        ));
    }

    /**
				 * @param \Teambank\RatenkaufByEasyCreditApiV3\Model\TransactionInitRequest $request
				 */
				public function addressesEqual($request) {
        $diff = array_diff_assoc(
            $this->convert($request->getOrderDetails()->getShippingAddress(), true), 
            $this->convert($request->getOrderDetails()->getInvoiceAddress(), true)
        );
        return (count($diff) === 0);
    }

    public function convert($address, $convertForCompare = false)
    {
        $_address = array(
            'strasseHausNr' => $address->getAddress(),
            'plz' => $address->getZip(),
            'ort' => $address->getCity(),
            'land' => $address->getCountry()
        );

        if ($address->getAdditionalAddressInformation()) {
            $_address['adresszusatz'] = $address->getAdditionalAddressInformation();

        }

        if (!$convertForCompare && $address instanceof ShippingAddress) {
            $_address = array_merge($_address, array(
                'vorname' => $address->getFirstname(),
                'nachname'  => $address->getLastname()
            ));

            if ($address->getIsPackstation()) {
                $_address['packstation'] = true;
            }
        }

        return $_address;
    }

	public function validate($request) {
        if (!$this->isCustomerSameAsBilling($request)) {
            throw new ValidationException('Zur Zahlung mit ratenkauf by easyCredit, müssen der Rechnungsempfänger und der Inhaber des Kundenkontos identisch sein.
                Bitte ändern Sie den Namen des Rechnungsempfängers entsprechend ab.');
        }

        if (!$this->addressesEqual($request)) {
            throw new AddressValidationException('Zur Zahlung mit ratenkauf by easyCredit muss die Rechnungsadresse mit der Lieferadresse übereinstimmen.');
        }

        $company = $request->getCustomer()->getCompanyName();
        if (trim($company) != '') {
            throw new ValidationException('ratenkauf by easyCredit ist nur für Privatpersonen möglich.');
        }
    }
}

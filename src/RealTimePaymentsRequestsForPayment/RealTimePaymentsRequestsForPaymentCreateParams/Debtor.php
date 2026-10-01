<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCreateParams;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCreateParams\Debtor\Address;

/**
 * Details of the person being requested to pay.
 *
 * @phpstan-import-type AddressShape from \Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCreateParams\Debtor\Address
 *
 * @phpstan-type DebtorShape = array{address: Address|AddressShape, name: string}
 */
final class Debtor implements BaseModel
{
    /** @use SdkModel<DebtorShape> */
    use SdkModel;

    /**
     * Address of the debtor.
     */
    #[Required]
    public Address $address;

    /**
     * The name of the debtor.
     */
    #[Required]
    public string $name;

    /**
     * `new Debtor()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Debtor::with(address: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Debtor)->withAddress(...)->withName(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Address|AddressShape $address
     */
    public static function with(Address|array $address, string $name): self
    {
        $self = new self;

        $self['address'] = $address;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Address of the debtor.
     *
     * @param Address|AddressShape $address
     */
    public function withAddress(Address|array $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    /**
     * The name of the debtor.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestForPayment;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestForPayment\Creditor\Address;

/**
 * Details of the party requesting payment.
 *
 * @phpstan-import-type AddressShape from \Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestForPayment\Creditor\Address
 *
 * @phpstan-type CreditorShape = array{
 *   accountName: string|null, address: Address|AddressShape, name: string
 * }
 */
final class Creditor implements BaseModel
{
    /** @use SdkModel<CreditorShape> */
    use SdkModel;

    /**
     * The name of the account that would receive the payment, as provided by the creditor.
     */
    #[Required('account_name')]
    public ?string $accountName;

    /**
     * Address of the creditor.
     */
    #[Required]
    public Address $address;

    /**
     * The name of the creditor.
     */
    #[Required]
    public string $name;

    /**
     * `new Creditor()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Creditor::with(accountName: ..., address: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Creditor)->withAccountName(...)->withAddress(...)->withName(...)
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
    public static function with(
        ?string $accountName,
        Address|array $address,
        string $name
    ): self {
        $self = new self;

        $self['accountName'] = $accountName;
        $self['address'] = $address;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The name of the account that would receive the payment, as provided by the creditor.
     */
    public function withAccountName(?string $accountName): self
    {
        $self = clone $this;
        $self['accountName'] = $accountName;

        return $self;
    }

    /**
     * Address of the creditor.
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
     * The name of the creditor.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\Checkbooks;

use Increase\Checkbooks\CheckbookCreateParams\MailingAddress;
use Increase\Checkbooks\CheckbookCreateParams\Payer;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a Checkbook.
 *
 * @see Increase\Services\CheckbooksService::create()
 *
 * @phpstan-import-type MailingAddressShape from \Increase\Checkbooks\CheckbookCreateParams\MailingAddress
 * @phpstan-import-type PayerShape from \Increase\Checkbooks\CheckbookCreateParams\Payer
 *
 * @phpstan-type CheckbookCreateParamsShape = array{
 *   accountNumberID: string,
 *   mailingAddress: MailingAddress|MailingAddressShape,
 *   payer: list<Payer|PayerShape>,
 * }
 */
final class CheckbookCreateParams implements BaseModel
{
    /** @use SdkModel<CheckbookCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Account Number that the checks will draw from. The Account Number must be active.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

    /**
     * The destination address that the Checkbook will be mailed to.
     */
    #[Required('mailing_address')]
    public MailingAddress $mailingAddress;

    /**
     * The payer of the checks. This will be printed on the top-left corner of each check. This should be an array of up to 4 elements, each of which represents a line of the payer.
     *
     * @var list<Payer> $payer
     */
    #[Required(list: Payer::class)]
    public array $payer;

    /**
     * `new CheckbookCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckbookCreateParams::with(
     *   accountNumberID: ..., mailingAddress: ..., payer: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckbookCreateParams)
     *   ->withAccountNumberID(...)
     *   ->withMailingAddress(...)
     *   ->withPayer(...)
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
     * @param MailingAddress|MailingAddressShape $mailingAddress
     * @param list<Payer|PayerShape> $payer
     */
    public static function with(
        string $accountNumberID,
        MailingAddress|array $mailingAddress,
        array $payer
    ): self {
        $self = new self;

        $self['accountNumberID'] = $accountNumberID;
        $self['mailingAddress'] = $mailingAddress;
        $self['payer'] = $payer;

        return $self;
    }

    /**
     * The identifier of the Account Number that the checks will draw from. The Account Number must be active.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * The destination address that the Checkbook will be mailed to.
     *
     * @param MailingAddress|MailingAddressShape $mailingAddress
     */
    public function withMailingAddress(
        MailingAddress|array $mailingAddress
    ): self {
        $self = clone $this;
        $self['mailingAddress'] = $mailingAddress;

        return $self;
    }

    /**
     * The payer of the checks. This will be printed on the top-left corner of each check. This should be an array of up to 4 elements, each of which represents a line of the payer.
     *
     * @param list<Payer|PayerShape> $payer
     */
    public function withPayer(array $payer): self
    {
        $self = clone $this;
        $self['payer'] = $payer;

        return $self;
    }
}

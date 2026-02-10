<?php

declare(strict_types=1);

namespace Increase\Exports\Export;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Exports\Export\VoidedCheck\Payer;

/**
 * Details of the voided check export. This field will be present when the `category` is equal to `voided_check`.
 *
 * @phpstan-import-type PayerShape from \Increase\Exports\Export\VoidedCheck\Payer
 *
 * @phpstan-type VoidedCheckShape = array{
 *   accountNumberID: string, payer: list<Payer|PayerShape>
 * }
 */
final class VoidedCheck implements BaseModel
{
    /** @use SdkModel<VoidedCheckShape> */
    use SdkModel;

    /**
     * The Account Number for the voided check.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

    /**
     * The payer information printed on the check.
     *
     * @var list<Payer> $payer
     */
    #[Required(list: Payer::class)]
    public array $payer;

    /**
     * `new VoidedCheck()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VoidedCheck::with(accountNumberID: ..., payer: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VoidedCheck)->withAccountNumberID(...)->withPayer(...)
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
     * @param list<Payer|PayerShape> $payer
     */
    public static function with(string $accountNumberID, array $payer): self
    {
        $self = new self;

        $self['accountNumberID'] = $accountNumberID;
        $self['payer'] = $payer;

        return $self;
    }

    /**
     * The Account Number for the voided check.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * The payer information printed on the check.
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

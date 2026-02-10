<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Exports\ExportCreateParams\VoidedCheck\Payer;

/**
 * Options for the created export. Required if `category` is equal to `voided_check`.
 *
 * @phpstan-import-type PayerShape from \Increase\Exports\ExportCreateParams\VoidedCheck\Payer
 *
 * @phpstan-type VoidedCheckShape = array{
 *   accountNumberID: string, payer?: list<Payer|PayerShape>|null
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
     * The payer information to be printed on the check.
     *
     * @var list<Payer>|null $payer
     */
    #[Optional(list: Payer::class)]
    public ?array $payer;

    /**
     * `new VoidedCheck()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VoidedCheck::with(accountNumberID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VoidedCheck)->withAccountNumberID(...)
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
     * @param list<Payer|PayerShape>|null $payer
     */
    public static function with(
        string $accountNumberID,
        ?array $payer = null
    ): self {
        $self = new self;

        $self['accountNumberID'] = $accountNumberID;

        null !== $payer && $self['payer'] = $payer;

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
     * The payer information to be printed on the check.
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

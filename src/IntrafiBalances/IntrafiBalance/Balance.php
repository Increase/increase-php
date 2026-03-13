<?php

declare(strict_types=1);

namespace Increase\IntrafiBalances\IntrafiBalance;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\IntrafiBalances\IntrafiBalance\Balance\BankLocation;

/**
 * @phpstan-import-type BankLocationShape from \Increase\IntrafiBalances\IntrafiBalance\Balance\BankLocation
 *
 * @phpstan-type BalanceShape = array{
 *   balance: int,
 *   bank: string,
 *   bankLocation: null|BankLocation|BankLocationShape,
 *   fdicCertificateNumber: string,
 * }
 */
final class Balance implements BaseModel
{
    /** @use SdkModel<BalanceShape> */
    use SdkModel;

    /**
     * The balance, in minor units of `currency`, held with this bank.
     */
    #[Required]
    public int $balance;

    /**
     * The name of the bank holding these funds.
     */
    #[Required]
    public string $bank;

    /**
     * The primary location of the bank.
     */
    #[Required('bank_location')]
    public ?BankLocation $bankLocation;

    /**
     * The Federal Deposit Insurance Corporation (FDIC) certificate number of the bank. Because many banks have the same or similar names, this can be used to uniquely identify the institution.
     */
    #[Required('fdic_certificate_number')]
    public string $fdicCertificateNumber;

    /**
     * `new Balance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Balance::with(
     *   balance: ..., bank: ..., bankLocation: ..., fdicCertificateNumber: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Balance)
     *   ->withBalance(...)
     *   ->withBank(...)
     *   ->withBankLocation(...)
     *   ->withFdicCertificateNumber(...)
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
     * @param BankLocation|BankLocationShape|null $bankLocation
     */
    public static function with(
        int $balance,
        string $bank,
        BankLocation|array|null $bankLocation,
        string $fdicCertificateNumber,
    ): self {
        $self = new self;

        $self['balance'] = $balance;
        $self['bank'] = $bank;
        $self['bankLocation'] = $bankLocation;
        $self['fdicCertificateNumber'] = $fdicCertificateNumber;

        return $self;
    }

    /**
     * The balance, in minor units of `currency`, held with this bank.
     */
    public function withBalance(int $balance): self
    {
        $self = clone $this;
        $self['balance'] = $balance;

        return $self;
    }

    /**
     * The name of the bank holding these funds.
     */
    public function withBank(string $bank): self
    {
        $self = clone $this;
        $self['bank'] = $bank;

        return $self;
    }

    /**
     * The primary location of the bank.
     *
     * @param BankLocation|BankLocationShape|null $bankLocation
     */
    public function withBankLocation(
        BankLocation|array|null $bankLocation
    ): self {
        $self = clone $this;
        $self['bankLocation'] = $bankLocation;

        return $self;
    }

    /**
     * The Federal Deposit Insurance Corporation (FDIC) certificate number of the bank. Because many banks have the same or similar names, this can be used to uniquely identify the institution.
     */
    public function withFdicCertificateNumber(
        string $fdicCertificateNumber
    ): self {
        $self = clone $this;
        $self['fdicCertificateNumber'] = $fdicCertificateNumber;

        return $self;
    }
}

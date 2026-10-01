<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details of the provisioned Digital Wallet Token. Present if and only if `outcome` is `provisioned`.
 *
 * @phpstan-type ProvisionedShape = array{digitalWalletTokenID: string}
 */
final class Provisioned implements BaseModel
{
    /** @use SdkModel<ProvisionedShape> */
    use SdkModel;

    /**
     * The identifier of the Digital Wallet Token that was provisioned.
     */
    #[Required('digital_wallet_token_id')]
    public string $digitalWalletTokenID;

    /**
     * `new Provisioned()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Provisioned::with(digitalWalletTokenID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Provisioned)->withDigitalWalletTokenID(...)
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
     */
    public static function with(string $digitalWalletTokenID): self
    {
        $self = new self;

        $self['digitalWalletTokenID'] = $digitalWalletTokenID;

        return $self;
    }

    /**
     * The identifier of the Digital Wallet Token that was provisioned.
     */
    public function withDigitalWalletTokenID(string $digitalWalletTokenID): self
    {
        $self = clone $this;
        $self['digitalWalletTokenID'] = $digitalWalletTokenID;

        return $self;
    }
}

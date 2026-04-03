<?php

declare(strict_types=1);

namespace Increase\Cards\Card\AuthorizationControls;

use Increase\Cards\Card\AuthorizationControls\MerchantAcceptorIdentifier\Allowed;
use Increase\Cards\Card\AuthorizationControls\MerchantAcceptorIdentifier\Blocked;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Restricts which Merchant Acceptor IDs are allowed or blocked for authorizations on this card.
 *
 * @phpstan-import-type AllowedShape from \Increase\Cards\Card\AuthorizationControls\MerchantAcceptorIdentifier\Allowed
 * @phpstan-import-type BlockedShape from \Increase\Cards\Card\AuthorizationControls\MerchantAcceptorIdentifier\Blocked
 *
 * @phpstan-type MerchantAcceptorIdentifierShape = array{
 *   allowed: list<Allowed|AllowedShape>|null,
 *   blocked: list<Blocked|BlockedShape>|null,
 * }
 */
final class MerchantAcceptorIdentifier implements BaseModel
{
    /** @use SdkModel<MerchantAcceptorIdentifierShape> */
    use SdkModel;

    /**
     * The Merchant Acceptor IDs that are allowed for authorizations on this card.
     *
     * @var list<Allowed>|null $allowed
     */
    #[Required(list: Allowed::class)]
    public ?array $allowed;

    /**
     * The Merchant Acceptor IDs that are blocked for authorizations on this card.
     *
     * @var list<Blocked>|null $blocked
     */
    #[Required(list: Blocked::class)]
    public ?array $blocked;

    /**
     * `new MerchantAcceptorIdentifier()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MerchantAcceptorIdentifier::with(allowed: ..., blocked: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MerchantAcceptorIdentifier)->withAllowed(...)->withBlocked(...)
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
     * @param list<Allowed|AllowedShape>|null $allowed
     * @param list<Blocked|BlockedShape>|null $blocked
     */
    public static function with(?array $allowed, ?array $blocked): self
    {
        $self = new self;

        $self['allowed'] = $allowed;
        $self['blocked'] = $blocked;

        return $self;
    }

    /**
     * The Merchant Acceptor IDs that are allowed for authorizations on this card.
     *
     * @param list<Allowed|AllowedShape>|null $allowed
     */
    public function withAllowed(?array $allowed): self
    {
        $self = clone $this;
        $self['allowed'] = $allowed;

        return $self;
    }

    /**
     * The Merchant Acceptor IDs that are blocked for authorizations on this card.
     *
     * @param list<Blocked|BlockedShape>|null $blocked
     */
    public function withBlocked(?array $blocked): self
    {
        $self = clone $this;
        $self['blocked'] = $blocked;

        return $self;
    }
}

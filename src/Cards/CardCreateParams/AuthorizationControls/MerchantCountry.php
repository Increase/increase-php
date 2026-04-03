<?php

declare(strict_types=1);

namespace Increase\Cards\CardCreateParams\AuthorizationControls;

use Increase\Cards\CardCreateParams\AuthorizationControls\MerchantCountry\Allowed;
use Increase\Cards\CardCreateParams\AuthorizationControls\MerchantCountry\Blocked;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Restricts which merchant countries are allowed or blocked for authorizations on this card.
 *
 * @phpstan-import-type AllowedShape from \Increase\Cards\CardCreateParams\AuthorizationControls\MerchantCountry\Allowed
 * @phpstan-import-type BlockedShape from \Increase\Cards\CardCreateParams\AuthorizationControls\MerchantCountry\Blocked
 *
 * @phpstan-type MerchantCountryShape = array{
 *   allowed?: list<Allowed|AllowedShape>|null,
 *   blocked?: list<Blocked|BlockedShape>|null,
 * }
 */
final class MerchantCountry implements BaseModel
{
    /** @use SdkModel<MerchantCountryShape> */
    use SdkModel;

    /**
     * The merchant countries that are allowed for authorizations on this card. Authorizations with merchant countries not in this list will be declined.
     *
     * @var list<Allowed>|null $allowed
     */
    #[Optional(list: Allowed::class)]
    public ?array $allowed;

    /**
     * The merchant countries that are blocked for authorizations on this card. Authorizations with merchant countries in this list will be declined.
     *
     * @var list<Blocked>|null $blocked
     */
    #[Optional(list: Blocked::class)]
    public ?array $blocked;

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
    public static function with(
        ?array $allowed = null,
        ?array $blocked = null
    ): self {
        $self = new self;

        null !== $allowed && $self['allowed'] = $allowed;
        null !== $blocked && $self['blocked'] = $blocked;

        return $self;
    }

    /**
     * The merchant countries that are allowed for authorizations on this card. Authorizations with merchant countries not in this list will be declined.
     *
     * @param list<Allowed|AllowedShape> $allowed
     */
    public function withAllowed(array $allowed): self
    {
        $self = clone $this;
        $self['allowed'] = $allowed;

        return $self;
    }

    /**
     * The merchant countries that are blocked for authorizations on this card. Authorizations with merchant countries in this list will be declined.
     *
     * @param list<Blocked|BlockedShape> $blocked
     */
    public function withBlocked(array $blocked): self
    {
        $self = clone $this;
        $self['blocked'] = $blocked;

        return $self;
    }
}

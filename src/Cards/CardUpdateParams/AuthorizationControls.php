<?php

declare(strict_types=1);

namespace Increase\Cards\CardUpdateParams;

use Increase\Cards\CardUpdateParams\AuthorizationControls\MerchantAcceptorIdentifier;
use Increase\Cards\CardUpdateParams\AuthorizationControls\MerchantCategoryCode;
use Increase\Cards\CardUpdateParams\AuthorizationControls\MerchantCountry;
use Increase\Cards\CardUpdateParams\AuthorizationControls\Usage;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Controls that restrict how this card can be used.
 *
 * @phpstan-import-type MerchantAcceptorIdentifierShape from \Increase\Cards\CardUpdateParams\AuthorizationControls\MerchantAcceptorIdentifier
 * @phpstan-import-type MerchantCategoryCodeShape from \Increase\Cards\CardUpdateParams\AuthorizationControls\MerchantCategoryCode
 * @phpstan-import-type MerchantCountryShape from \Increase\Cards\CardUpdateParams\AuthorizationControls\MerchantCountry
 * @phpstan-import-type UsageShape from \Increase\Cards\CardUpdateParams\AuthorizationControls\Usage
 *
 * @phpstan-type AuthorizationControlsShape = array{
 *   merchantAcceptorIdentifier?: null|MerchantAcceptorIdentifier|MerchantAcceptorIdentifierShape,
 *   merchantCategoryCode?: null|MerchantCategoryCode|MerchantCategoryCodeShape,
 *   merchantCountry?: null|MerchantCountry|MerchantCountryShape,
 *   usage?: null|Usage|UsageShape,
 * }
 */
final class AuthorizationControls implements BaseModel
{
    /** @use SdkModel<AuthorizationControlsShape> */
    use SdkModel;

    /**
     * Restricts which Merchant Acceptor IDs are allowed or blocked for authorizations on this card.
     */
    #[Optional('merchant_acceptor_identifier')]
    public ?MerchantAcceptorIdentifier $merchantAcceptorIdentifier;

    /**
     * Restricts which Merchant Category Codes are allowed or blocked for authorizations on this card.
     */
    #[Optional('merchant_category_code')]
    public ?MerchantCategoryCode $merchantCategoryCode;

    /**
     * Restricts which merchant countries are allowed or blocked for authorizations on this card.
     */
    #[Optional('merchant_country')]
    public ?MerchantCountry $merchantCountry;

    /**
     * Controls how many times this card can be used.
     */
    #[Optional]
    public ?Usage $usage;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param MerchantAcceptorIdentifier|MerchantAcceptorIdentifierShape|null $merchantAcceptorIdentifier
     * @param MerchantCategoryCode|MerchantCategoryCodeShape|null $merchantCategoryCode
     * @param MerchantCountry|MerchantCountryShape|null $merchantCountry
     * @param Usage|UsageShape|null $usage
     */
    public static function with(
        MerchantAcceptorIdentifier|array|null $merchantAcceptorIdentifier = null,
        MerchantCategoryCode|array|null $merchantCategoryCode = null,
        MerchantCountry|array|null $merchantCountry = null,
        Usage|array|null $usage = null,
    ): self {
        $self = new self;

        null !== $merchantAcceptorIdentifier && $self['merchantAcceptorIdentifier'] = $merchantAcceptorIdentifier;
        null !== $merchantCategoryCode && $self['merchantCategoryCode'] = $merchantCategoryCode;
        null !== $merchantCountry && $self['merchantCountry'] = $merchantCountry;
        null !== $usage && $self['usage'] = $usage;

        return $self;
    }

    /**
     * Restricts which Merchant Acceptor IDs are allowed or blocked for authorizations on this card.
     *
     * @param MerchantAcceptorIdentifier|MerchantAcceptorIdentifierShape $merchantAcceptorIdentifier
     */
    public function withMerchantAcceptorIdentifier(
        MerchantAcceptorIdentifier|array $merchantAcceptorIdentifier
    ): self {
        $self = clone $this;
        $self['merchantAcceptorIdentifier'] = $merchantAcceptorIdentifier;

        return $self;
    }

    /**
     * Restricts which Merchant Category Codes are allowed or blocked for authorizations on this card.
     *
     * @param MerchantCategoryCode|MerchantCategoryCodeShape $merchantCategoryCode
     */
    public function withMerchantCategoryCode(
        MerchantCategoryCode|array $merchantCategoryCode
    ): self {
        $self = clone $this;
        $self['merchantCategoryCode'] = $merchantCategoryCode;

        return $self;
    }

    /**
     * Restricts which merchant countries are allowed or blocked for authorizations on this card.
     *
     * @param MerchantCountry|MerchantCountryShape $merchantCountry
     */
    public function withMerchantCountry(
        MerchantCountry|array $merchantCountry
    ): self {
        $self = clone $this;
        $self['merchantCountry'] = $merchantCountry;

        return $self;
    }

    /**
     * Controls how many times this card can be used.
     *
     * @param Usage|UsageShape $usage
     */
    public function withUsage(Usage|array $usage): self
    {
        $self = clone $this;
        $self['usage'] = $usage;

        return $self;
    }
}

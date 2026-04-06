<?php

declare(strict_types=1);

namespace Increase\Cards\Card;

use Increase\Cards\Card\AuthorizationControls\MerchantAcceptorIdentifier;
use Increase\Cards\Card\AuthorizationControls\MerchantCategoryCode;
use Increase\Cards\Card\AuthorizationControls\MerchantCountry;
use Increase\Cards\Card\AuthorizationControls\Usage;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Controls that restrict how this card can be used.
 *
 * @phpstan-import-type MerchantAcceptorIdentifierShape from \Increase\Cards\Card\AuthorizationControls\MerchantAcceptorIdentifier
 * @phpstan-import-type MerchantCategoryCodeShape from \Increase\Cards\Card\AuthorizationControls\MerchantCategoryCode
 * @phpstan-import-type MerchantCountryShape from \Increase\Cards\Card\AuthorizationControls\MerchantCountry
 * @phpstan-import-type UsageShape from \Increase\Cards\Card\AuthorizationControls\Usage
 *
 * @phpstan-type AuthorizationControlsShape = array{
 *   merchantAcceptorIdentifier: null|MerchantAcceptorIdentifier|MerchantAcceptorIdentifierShape,
 *   merchantCategoryCode: null|MerchantCategoryCode|MerchantCategoryCodeShape,
 *   merchantCountry: null|MerchantCountry|MerchantCountryShape,
 *   usage: null|Usage|UsageShape,
 * }
 */
final class AuthorizationControls implements BaseModel
{
    /** @use SdkModel<AuthorizationControlsShape> */
    use SdkModel;

    /**
     * Restricts which Merchant Acceptor IDs are allowed or blocked for authorizations on this card.
     */
    #[Required('merchant_acceptor_identifier')]
    public ?MerchantAcceptorIdentifier $merchantAcceptorIdentifier;

    /**
     * Restricts which Merchant Category Codes are allowed or blocked for authorizations on this card.
     */
    #[Required('merchant_category_code')]
    public ?MerchantCategoryCode $merchantCategoryCode;

    /**
     * Restricts which merchant countries are allowed or blocked for authorizations on this card.
     */
    #[Required('merchant_country')]
    public ?MerchantCountry $merchantCountry;

    /**
     * Controls how many times this card can be used.
     */
    #[Required]
    public ?Usage $usage;

    /**
     * `new AuthorizationControls()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AuthorizationControls::with(
     *   merchantAcceptorIdentifier: ...,
     *   merchantCategoryCode: ...,
     *   merchantCountry: ...,
     *   usage: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AuthorizationControls)
     *   ->withMerchantAcceptorIdentifier(...)
     *   ->withMerchantCategoryCode(...)
     *   ->withMerchantCountry(...)
     *   ->withUsage(...)
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
     * @param MerchantAcceptorIdentifier|MerchantAcceptorIdentifierShape|null $merchantAcceptorIdentifier
     * @param MerchantCategoryCode|MerchantCategoryCodeShape|null $merchantCategoryCode
     * @param MerchantCountry|MerchantCountryShape|null $merchantCountry
     * @param Usage|UsageShape|null $usage
     */
    public static function with(
        MerchantAcceptorIdentifier|array|null $merchantAcceptorIdentifier,
        MerchantCategoryCode|array|null $merchantCategoryCode,
        MerchantCountry|array|null $merchantCountry,
        Usage|array|null $usage,
    ): self {
        $self = new self;

        $self['merchantAcceptorIdentifier'] = $merchantAcceptorIdentifier;
        $self['merchantCategoryCode'] = $merchantCategoryCode;
        $self['merchantCountry'] = $merchantCountry;
        $self['usage'] = $usage;

        return $self;
    }

    /**
     * Restricts which Merchant Acceptor IDs are allowed or blocked for authorizations on this card.
     *
     * @param MerchantAcceptorIdentifier|MerchantAcceptorIdentifierShape|null $merchantAcceptorIdentifier
     */
    public function withMerchantAcceptorIdentifier(
        MerchantAcceptorIdentifier|array|null $merchantAcceptorIdentifier
    ): self {
        $self = clone $this;
        $self['merchantAcceptorIdentifier'] = $merchantAcceptorIdentifier;

        return $self;
    }

    /**
     * Restricts which Merchant Category Codes are allowed or blocked for authorizations on this card.
     *
     * @param MerchantCategoryCode|MerchantCategoryCodeShape|null $merchantCategoryCode
     */
    public function withMerchantCategoryCode(
        MerchantCategoryCode|array|null $merchantCategoryCode
    ): self {
        $self = clone $this;
        $self['merchantCategoryCode'] = $merchantCategoryCode;

        return $self;
    }

    /**
     * Restricts which merchant countries are allowed or blocked for authorizations on this card.
     *
     * @param MerchantCountry|MerchantCountryShape|null $merchantCountry
     */
    public function withMerchantCountry(
        MerchantCountry|array|null $merchantCountry
    ): self {
        $self = clone $this;
        $self['merchantCountry'] = $merchantCountry;

        return $self;
    }

    /**
     * Controls how many times this card can be used.
     *
     * @param Usage|UsageShape|null $usage
     */
    public function withUsage(Usage|array|null $usage): self
    {
        $self = clone $this;
        $self['usage'] = $usage;

        return $self;
    }
}

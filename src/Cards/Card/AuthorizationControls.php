<?php

declare(strict_types=1);

namespace Increase\Cards\Card;

use Increase\Cards\Card\AuthorizationControls\MaximumAuthorizationCount;
use Increase\Cards\Card\AuthorizationControls\MerchantAcceptorIdentifier;
use Increase\Cards\Card\AuthorizationControls\MerchantCategoryCode;
use Increase\Cards\Card\AuthorizationControls\MerchantCountry;
use Increase\Cards\Card\AuthorizationControls\SpendingLimit;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Controls that restrict how this card can be used.
 *
 * @phpstan-import-type MaximumAuthorizationCountShape from \Increase\Cards\Card\AuthorizationControls\MaximumAuthorizationCount
 * @phpstan-import-type MerchantAcceptorIdentifierShape from \Increase\Cards\Card\AuthorizationControls\MerchantAcceptorIdentifier
 * @phpstan-import-type MerchantCategoryCodeShape from \Increase\Cards\Card\AuthorizationControls\MerchantCategoryCode
 * @phpstan-import-type MerchantCountryShape from \Increase\Cards\Card\AuthorizationControls\MerchantCountry
 * @phpstan-import-type SpendingLimitShape from \Increase\Cards\Card\AuthorizationControls\SpendingLimit
 *
 * @phpstan-type AuthorizationControlsShape = array{
 *   maximumAuthorizationCount: null|MaximumAuthorizationCount|MaximumAuthorizationCountShape,
 *   merchantAcceptorIdentifier: null|MerchantAcceptorIdentifier|MerchantAcceptorIdentifierShape,
 *   merchantCategoryCode: null|MerchantCategoryCode|MerchantCategoryCodeShape,
 *   merchantCountry: null|MerchantCountry|MerchantCountryShape,
 *   spendingLimits: list<SpendingLimit|SpendingLimitShape>|null,
 * }
 */
final class AuthorizationControls implements BaseModel
{
    /** @use SdkModel<AuthorizationControlsShape> */
    use SdkModel;

    /**
     * Limits the number of authorizations that can be approved on this card.
     */
    #[Required('maximum_authorization_count')]
    public ?MaximumAuthorizationCount $maximumAuthorizationCount;

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
     * Spending limits for this card. The most restrictive limit is applied if multiple limits match.
     *
     * @var list<SpendingLimit>|null $spendingLimits
     */
    #[Required('spending_limits', list: SpendingLimit::class)]
    public ?array $spendingLimits;

    /**
     * `new AuthorizationControls()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AuthorizationControls::with(
     *   maximumAuthorizationCount: ...,
     *   merchantAcceptorIdentifier: ...,
     *   merchantCategoryCode: ...,
     *   merchantCountry: ...,
     *   spendingLimits: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AuthorizationControls)
     *   ->withMaximumAuthorizationCount(...)
     *   ->withMerchantAcceptorIdentifier(...)
     *   ->withMerchantCategoryCode(...)
     *   ->withMerchantCountry(...)
     *   ->withSpendingLimits(...)
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
     * @param MaximumAuthorizationCount|MaximumAuthorizationCountShape|null $maximumAuthorizationCount
     * @param MerchantAcceptorIdentifier|MerchantAcceptorIdentifierShape|null $merchantAcceptorIdentifier
     * @param MerchantCategoryCode|MerchantCategoryCodeShape|null $merchantCategoryCode
     * @param MerchantCountry|MerchantCountryShape|null $merchantCountry
     * @param list<SpendingLimit|SpendingLimitShape>|null $spendingLimits
     */
    public static function with(
        MaximumAuthorizationCount|array|null $maximumAuthorizationCount,
        MerchantAcceptorIdentifier|array|null $merchantAcceptorIdentifier,
        MerchantCategoryCode|array|null $merchantCategoryCode,
        MerchantCountry|array|null $merchantCountry,
        ?array $spendingLimits,
    ): self {
        $self = new self;

        $self['maximumAuthorizationCount'] = $maximumAuthorizationCount;
        $self['merchantAcceptorIdentifier'] = $merchantAcceptorIdentifier;
        $self['merchantCategoryCode'] = $merchantCategoryCode;
        $self['merchantCountry'] = $merchantCountry;
        $self['spendingLimits'] = $spendingLimits;

        return $self;
    }

    /**
     * Limits the number of authorizations that can be approved on this card.
     *
     * @param MaximumAuthorizationCount|MaximumAuthorizationCountShape|null $maximumAuthorizationCount
     */
    public function withMaximumAuthorizationCount(
        MaximumAuthorizationCount|array|null $maximumAuthorizationCount
    ): self {
        $self = clone $this;
        $self['maximumAuthorizationCount'] = $maximumAuthorizationCount;

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
     * Spending limits for this card. The most restrictive limit is applied if multiple limits match.
     *
     * @param list<SpendingLimit|SpendingLimitShape>|null $spendingLimits
     */
    public function withSpendingLimits(?array $spendingLimits): self
    {
        $self = clone $this;
        $self['spendingLimits'] = $spendingLimits;

        return $self;
    }
}

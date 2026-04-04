<?php

declare(strict_types=1);

namespace Increase\Cards\CardUpdateParams;

use Increase\Cards\CardUpdateParams\AuthorizationControls\MaximumAuthorizationCount;
use Increase\Cards\CardUpdateParams\AuthorizationControls\MerchantAcceptorIdentifier;
use Increase\Cards\CardUpdateParams\AuthorizationControls\MerchantCategoryCode;
use Increase\Cards\CardUpdateParams\AuthorizationControls\MerchantCountry;
use Increase\Cards\CardUpdateParams\AuthorizationControls\SpendingLimit;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Controls that restrict how this card can be used.
 *
 * @phpstan-import-type MaximumAuthorizationCountShape from \Increase\Cards\CardUpdateParams\AuthorizationControls\MaximumAuthorizationCount
 * @phpstan-import-type MerchantAcceptorIdentifierShape from \Increase\Cards\CardUpdateParams\AuthorizationControls\MerchantAcceptorIdentifier
 * @phpstan-import-type MerchantCategoryCodeShape from \Increase\Cards\CardUpdateParams\AuthorizationControls\MerchantCategoryCode
 * @phpstan-import-type MerchantCountryShape from \Increase\Cards\CardUpdateParams\AuthorizationControls\MerchantCountry
 * @phpstan-import-type SpendingLimitShape from \Increase\Cards\CardUpdateParams\AuthorizationControls\SpendingLimit
 *
 * @phpstan-type AuthorizationControlsShape = array{
 *   maximumAuthorizationCount?: null|MaximumAuthorizationCount|MaximumAuthorizationCountShape,
 *   merchantAcceptorIdentifier?: null|MerchantAcceptorIdentifier|MerchantAcceptorIdentifierShape,
 *   merchantCategoryCode?: null|MerchantCategoryCode|MerchantCategoryCodeShape,
 *   merchantCountry?: null|MerchantCountry|MerchantCountryShape,
 *   spendingLimits?: list<SpendingLimit|SpendingLimitShape>|null,
 * }
 */
final class AuthorizationControls implements BaseModel
{
    /** @use SdkModel<AuthorizationControlsShape> */
    use SdkModel;

    /**
     * Limits the number of authorizations that can be approved on this card.
     */
    #[Optional('maximum_authorization_count')]
    public ?MaximumAuthorizationCount $maximumAuthorizationCount;

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
     * Spending limits for this card. The most restrictive limit applies if multiple limits match.
     *
     * @var list<SpendingLimit>|null $spendingLimits
     */
    #[Optional('spending_limits', list: SpendingLimit::class)]
    public ?array $spendingLimits;

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
        MaximumAuthorizationCount|array|null $maximumAuthorizationCount = null,
        MerchantAcceptorIdentifier|array|null $merchantAcceptorIdentifier = null,
        MerchantCategoryCode|array|null $merchantCategoryCode = null,
        MerchantCountry|array|null $merchantCountry = null,
        ?array $spendingLimits = null,
    ): self {
        $self = new self;

        null !== $maximumAuthorizationCount && $self['maximumAuthorizationCount'] = $maximumAuthorizationCount;
        null !== $merchantAcceptorIdentifier && $self['merchantAcceptorIdentifier'] = $merchantAcceptorIdentifier;
        null !== $merchantCategoryCode && $self['merchantCategoryCode'] = $merchantCategoryCode;
        null !== $merchantCountry && $self['merchantCountry'] = $merchantCountry;
        null !== $spendingLimits && $self['spendingLimits'] = $spendingLimits;

        return $self;
    }

    /**
     * Limits the number of authorizations that can be approved on this card.
     *
     * @param MaximumAuthorizationCount|MaximumAuthorizationCountShape $maximumAuthorizationCount
     */
    public function withMaximumAuthorizationCount(
        MaximumAuthorizationCount|array $maximumAuthorizationCount
    ): self {
        $self = clone $this;
        $self['maximumAuthorizationCount'] = $maximumAuthorizationCount;

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
     * Spending limits for this card. The most restrictive limit applies if multiple limits match.
     *
     * @param list<SpendingLimit|SpendingLimitShape> $spendingLimits
     */
    public function withSpendingLimits(array $spendingLimits): self
    {
        $self = clone $this;
        $self['spendingLimits'] = $spendingLimits;

        return $self;
    }
}

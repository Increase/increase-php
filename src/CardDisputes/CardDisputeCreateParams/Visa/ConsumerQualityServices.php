<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa;

use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityServices\CardholderCancellation;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityServices\CardholderPaidToHaveWorkRedone;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityServices\NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityServices\OngoingNegotiations;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityServices\RestaurantFoodRelated;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Services quality issue. Required if and only if `category` is `consumer_quality_services`.
 *
 * @phpstan-import-type CardholderCancellationShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityServices\CardholderCancellation
 * @phpstan-import-type OngoingNegotiationsShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityServices\OngoingNegotiations
 *
 * @phpstan-type ConsumerQualityServicesShape = array{
 *   cardholderCancellation: CardholderCancellation|CardholderCancellationShape,
 *   nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription: NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription|value-of<NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription>,
 *   purchaseInfoAndQualityIssue: string,
 *   servicesReceivedAt: string,
 *   cardholderPaidToHaveWorkRedone?: null|CardholderPaidToHaveWorkRedone|value-of<CardholderPaidToHaveWorkRedone>,
 *   ongoingNegotiations?: null|OngoingNegotiations|OngoingNegotiationsShape,
 *   restaurantFoodRelated?: null|RestaurantFoodRelated|value-of<RestaurantFoodRelated>,
 * }
 */
final class ConsumerQualityServices implements BaseModel
{
    /** @use SdkModel<ConsumerQualityServicesShape> */
    use SdkModel;

    /**
     * Cardholder cancellation.
     */
    #[Required('cardholder_cancellation')]
    public CardholderCancellation $cardholderCancellation;

    /**
     * Non-fiat currency or non-fungible token related and not matching description.
     *
     * @var value-of<NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription> $nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription
     */
    #[Required(
        'non_fiat_currency_or_non_fungible_token_related_and_not_matching_description',
        enum: NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription::class,
    )]
    public string $nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription;

    /**
     * Purchase information and quality issue.
     */
    #[Required('purchase_info_and_quality_issue')]
    public string $purchaseInfoAndQualityIssue;

    /**
     * Services received at.
     */
    #[Required('services_received_at')]
    public string $servicesReceivedAt;

    /**
     * Cardholder paid to have work redone.
     *
     * @var value-of<CardholderPaidToHaveWorkRedone>|null $cardholderPaidToHaveWorkRedone
     */
    #[Optional(
        'cardholder_paid_to_have_work_redone',
        enum: CardholderPaidToHaveWorkRedone::class,
    )]
    public ?string $cardholderPaidToHaveWorkRedone;

    /**
     * Ongoing negotiations. Exclude if there is no evidence of ongoing negotiations.
     */
    #[Optional('ongoing_negotiations')]
    public ?OngoingNegotiations $ongoingNegotiations;

    /**
     * Whether the dispute is related to the quality of food from an eating place or restaurant. Must be provided when Merchant Category Code (MCC) is 5812, 5813 or 5814.
     *
     * @var value-of<RestaurantFoodRelated>|null $restaurantFoodRelated
     */
    #[Optional('restaurant_food_related', enum: RestaurantFoodRelated::class)]
    public ?string $restaurantFoodRelated;

    /**
     * `new ConsumerQualityServices()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerQualityServices::with(
     *   cardholderCancellation: ...,
     *   nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription: ...,
     *   purchaseInfoAndQualityIssue: ...,
     *   servicesReceivedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerQualityServices)
     *   ->withCardholderCancellation(...)
     *   ->withNonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription(...)
     *   ->withPurchaseInfoAndQualityIssue(...)
     *   ->withServicesReceivedAt(...)
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
     * @param CardholderCancellation|CardholderCancellationShape $cardholderCancellation
     * @param NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription|value-of<NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription> $nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription
     * @param CardholderPaidToHaveWorkRedone|value-of<CardholderPaidToHaveWorkRedone>|null $cardholderPaidToHaveWorkRedone
     * @param OngoingNegotiations|OngoingNegotiationsShape|null $ongoingNegotiations
     * @param RestaurantFoodRelated|value-of<RestaurantFoodRelated>|null $restaurantFoodRelated
     */
    public static function with(
        CardholderCancellation|array $cardholderCancellation,
        NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription|string $nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription,
        string $purchaseInfoAndQualityIssue,
        string $servicesReceivedAt,
        CardholderPaidToHaveWorkRedone|string|null $cardholderPaidToHaveWorkRedone = null,
        OngoingNegotiations|array|null $ongoingNegotiations = null,
        RestaurantFoodRelated|string|null $restaurantFoodRelated = null,
    ): self {
        $self = new self;

        $self['cardholderCancellation'] = $cardholderCancellation;
        $self['nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription'] = $nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription;
        $self['purchaseInfoAndQualityIssue'] = $purchaseInfoAndQualityIssue;
        $self['servicesReceivedAt'] = $servicesReceivedAt;

        null !== $cardholderPaidToHaveWorkRedone && $self['cardholderPaidToHaveWorkRedone'] = $cardholderPaidToHaveWorkRedone;
        null !== $ongoingNegotiations && $self['ongoingNegotiations'] = $ongoingNegotiations;
        null !== $restaurantFoodRelated && $self['restaurantFoodRelated'] = $restaurantFoodRelated;

        return $self;
    }

    /**
     * Cardholder cancellation.
     *
     * @param CardholderCancellation|CardholderCancellationShape $cardholderCancellation
     */
    public function withCardholderCancellation(
        CardholderCancellation|array $cardholderCancellation
    ): self {
        $self = clone $this;
        $self['cardholderCancellation'] = $cardholderCancellation;

        return $self;
    }

    /**
     * Non-fiat currency or non-fungible token related and not matching description.
     *
     * @param NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription|value-of<NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription> $nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription
     */
    public function withNonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription(
        NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription|string $nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription,
    ): self {
        $self = clone $this;
        $self['nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription'] = $nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription;

        return $self;
    }

    /**
     * Purchase information and quality issue.
     */
    public function withPurchaseInfoAndQualityIssue(
        string $purchaseInfoAndQualityIssue
    ): self {
        $self = clone $this;
        $self['purchaseInfoAndQualityIssue'] = $purchaseInfoAndQualityIssue;

        return $self;
    }

    /**
     * Services received at.
     */
    public function withServicesReceivedAt(string $servicesReceivedAt): self
    {
        $self = clone $this;
        $self['servicesReceivedAt'] = $servicesReceivedAt;

        return $self;
    }

    /**
     * Cardholder paid to have work redone.
     *
     * @param CardholderPaidToHaveWorkRedone|value-of<CardholderPaidToHaveWorkRedone> $cardholderPaidToHaveWorkRedone
     */
    public function withCardholderPaidToHaveWorkRedone(
        CardholderPaidToHaveWorkRedone|string $cardholderPaidToHaveWorkRedone
    ): self {
        $self = clone $this;
        $self['cardholderPaidToHaveWorkRedone'] = $cardholderPaidToHaveWorkRedone;

        return $self;
    }

    /**
     * Ongoing negotiations. Exclude if there is no evidence of ongoing negotiations.
     *
     * @param OngoingNegotiations|OngoingNegotiationsShape $ongoingNegotiations
     */
    public function withOngoingNegotiations(
        OngoingNegotiations|array $ongoingNegotiations
    ): self {
        $self = clone $this;
        $self['ongoingNegotiations'] = $ongoingNegotiations;

        return $self;
    }

    /**
     * Whether the dispute is related to the quality of food from an eating place or restaurant. Must be provided when Merchant Category Code (MCC) is 5812, 5813 or 5814.
     *
     * @param RestaurantFoodRelated|value-of<RestaurantFoodRelated> $restaurantFoodRelated
     */
    public function withRestaurantFoodRelated(
        RestaurantFoodRelated|string $restaurantFoodRelated
    ): self {
        $self = clone $this;
        $self['restaurantFoodRelated'] = $restaurantFoodRelated;

        return $self;
    }
}

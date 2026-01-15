<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityServices\CardholderCancellation;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityServices\CardholderPaidToHaveWorkRedone;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityServices\NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityServices\OngoingNegotiations;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityServices\RestaurantFoodRelated;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Services quality issue. Present if and only if `category` is `consumer_quality_services`.
 *
 * @phpstan-import-type CardholderCancellationShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityServices\CardholderCancellation
 * @phpstan-import-type OngoingNegotiationsShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityServices\OngoingNegotiations
 *
 * @phpstan-type ConsumerQualityServicesShape = array{
 *   cardholderCancellation: CardholderCancellation|CardholderCancellationShape,
 *   cardholderPaidToHaveWorkRedone: null|CardholderPaidToHaveWorkRedone|value-of<CardholderPaidToHaveWorkRedone>,
 *   nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription: NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription|value-of<NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription>,
 *   ongoingNegotiations: null|OngoingNegotiations|OngoingNegotiationsShape,
 *   purchaseInfoAndQualityIssue: string,
 *   restaurantFoodRelated: null|RestaurantFoodRelated|value-of<RestaurantFoodRelated>,
 *   servicesReceivedAt: string,
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
     * Cardholder paid to have work redone.
     *
     * @var value-of<CardholderPaidToHaveWorkRedone>|null $cardholderPaidToHaveWorkRedone
     */
    #[Required(
        'cardholder_paid_to_have_work_redone',
        enum: CardholderPaidToHaveWorkRedone::class,
    )]
    public ?string $cardholderPaidToHaveWorkRedone;

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
     * Ongoing negotiations. Exclude if there is no evidence of ongoing negotiations.
     */
    #[Required('ongoing_negotiations')]
    public ?OngoingNegotiations $ongoingNegotiations;

    /**
     * Purchase information and quality issue.
     */
    #[Required('purchase_info_and_quality_issue')]
    public string $purchaseInfoAndQualityIssue;

    /**
     * Whether the dispute is related to the quality of food from an eating place or restaurant. Must be provided when Merchant Category Code (MCC) is 5812, 5813 or 5814.
     *
     * @var value-of<RestaurantFoodRelated>|null $restaurantFoodRelated
     */
    #[Required('restaurant_food_related', enum: RestaurantFoodRelated::class)]
    public ?string $restaurantFoodRelated;

    /**
     * Services received at.
     */
    #[Required('services_received_at')]
    public string $servicesReceivedAt;

    /**
     * `new ConsumerQualityServices()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerQualityServices::with(
     *   cardholderCancellation: ...,
     *   cardholderPaidToHaveWorkRedone: ...,
     *   nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription: ...,
     *   ongoingNegotiations: ...,
     *   purchaseInfoAndQualityIssue: ...,
     *   restaurantFoodRelated: ...,
     *   servicesReceivedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerQualityServices)
     *   ->withCardholderCancellation(...)
     *   ->withCardholderPaidToHaveWorkRedone(...)
     *   ->withNonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription(...)
     *   ->withOngoingNegotiations(...)
     *   ->withPurchaseInfoAndQualityIssue(...)
     *   ->withRestaurantFoodRelated(...)
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
     * @param CardholderPaidToHaveWorkRedone|value-of<CardholderPaidToHaveWorkRedone>|null $cardholderPaidToHaveWorkRedone
     * @param NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription|value-of<NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription> $nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription
     * @param OngoingNegotiations|OngoingNegotiationsShape|null $ongoingNegotiations
     * @param RestaurantFoodRelated|value-of<RestaurantFoodRelated>|null $restaurantFoodRelated
     */
    public static function with(
        CardholderCancellation|array $cardholderCancellation,
        CardholderPaidToHaveWorkRedone|string|null $cardholderPaidToHaveWorkRedone,
        NonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription|string $nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription,
        OngoingNegotiations|array|null $ongoingNegotiations,
        string $purchaseInfoAndQualityIssue,
        RestaurantFoodRelated|string|null $restaurantFoodRelated,
        string $servicesReceivedAt,
    ): self {
        $self = new self;

        $self['cardholderCancellation'] = $cardholderCancellation;
        $self['cardholderPaidToHaveWorkRedone'] = $cardholderPaidToHaveWorkRedone;
        $self['nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription'] = $nonFiatCurrencyOrNonFungibleTokenRelatedAndNotMatchingDescription;
        $self['ongoingNegotiations'] = $ongoingNegotiations;
        $self['purchaseInfoAndQualityIssue'] = $purchaseInfoAndQualityIssue;
        $self['restaurantFoodRelated'] = $restaurantFoodRelated;
        $self['servicesReceivedAt'] = $servicesReceivedAt;

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
     * Cardholder paid to have work redone.
     *
     * @param CardholderPaidToHaveWorkRedone|value-of<CardholderPaidToHaveWorkRedone>|null $cardholderPaidToHaveWorkRedone
     */
    public function withCardholderPaidToHaveWorkRedone(
        CardholderPaidToHaveWorkRedone|string|null $cardholderPaidToHaveWorkRedone
    ): self {
        $self = clone $this;
        $self['cardholderPaidToHaveWorkRedone'] = $cardholderPaidToHaveWorkRedone;

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
     * Ongoing negotiations. Exclude if there is no evidence of ongoing negotiations.
     *
     * @param OngoingNegotiations|OngoingNegotiationsShape|null $ongoingNegotiations
     */
    public function withOngoingNegotiations(
        OngoingNegotiations|array|null $ongoingNegotiations
    ): self {
        $self = clone $this;
        $self['ongoingNegotiations'] = $ongoingNegotiations;

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
     * Whether the dispute is related to the quality of food from an eating place or restaurant. Must be provided when Merchant Category Code (MCC) is 5812, 5813 or 5814.
     *
     * @param RestaurantFoodRelated|value-of<RestaurantFoodRelated>|null $restaurantFoodRelated
     */
    public function withRestaurantFoodRelated(
        RestaurantFoodRelated|string|null $restaurantFoodRelated
    ): self {
        $self = clone $this;
        $self['restaurantFoodRelated'] = $restaurantFoodRelated;

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
}

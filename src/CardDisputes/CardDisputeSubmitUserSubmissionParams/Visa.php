<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams;

use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Category;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\MerchantPrearbitrationDecline;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\UserPrearbitration;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The Visa-specific parameters for the dispute. Required if and only if `network` is `visa`.
 *
 * @phpstan-import-type ChargebackShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback
 * @phpstan-import-type MerchantPrearbitrationDeclineShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\MerchantPrearbitrationDecline
 * @phpstan-import-type UserPrearbitrationShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\UserPrearbitration
 *
 * @phpstan-type VisaShape = array{
 *   category: Category|value-of<Category>,
 *   chargeback?: null|Chargeback|ChargebackShape,
 *   merchantPrearbitrationDecline?: null|MerchantPrearbitrationDecline|MerchantPrearbitrationDeclineShape,
 *   userPrearbitration?: null|UserPrearbitration|UserPrearbitrationShape,
 * }
 */
final class Visa implements BaseModel
{
    /** @use SdkModel<VisaShape> */
    use SdkModel;

    /**
     * The category of the user submission. Details specific to the category are required under the sub-object with the same identifier as the category.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * The chargeback details for the user submission. Required if and only if `category` is `chargeback`.
     */
    #[Optional]
    public ?Chargeback $chargeback;

    /**
     * The merchant pre-arbitration decline details for the user submission. Required if and only if `category` is `merchant_prearbitration_decline`.
     */
    #[Optional('merchant_prearbitration_decline')]
    public ?MerchantPrearbitrationDecline $merchantPrearbitrationDecline;

    /**
     * The user pre-arbitration details for the user submission. Required if and only if `category` is `user_prearbitration`.
     */
    #[Optional('user_prearbitration')]
    public ?UserPrearbitration $userPrearbitration;

    /**
     * `new Visa()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Visa::with(category: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Visa)->withCategory(...)
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
     * @param Category|value-of<Category> $category
     * @param Chargeback|ChargebackShape|null $chargeback
     * @param MerchantPrearbitrationDecline|MerchantPrearbitrationDeclineShape|null $merchantPrearbitrationDecline
     * @param UserPrearbitration|UserPrearbitrationShape|null $userPrearbitration
     */
    public static function with(
        Category|string $category,
        Chargeback|array|null $chargeback = null,
        MerchantPrearbitrationDecline|array|null $merchantPrearbitrationDecline = null,
        UserPrearbitration|array|null $userPrearbitration = null,
    ): self {
        $self = new self;

        $self['category'] = $category;

        null !== $chargeback && $self['chargeback'] = $chargeback;
        null !== $merchantPrearbitrationDecline && $self['merchantPrearbitrationDecline'] = $merchantPrearbitrationDecline;
        null !== $userPrearbitration && $self['userPrearbitration'] = $userPrearbitration;

        return $self;
    }

    /**
     * The category of the user submission. Details specific to the category are required under the sub-object with the same identifier as the category.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * The chargeback details for the user submission. Required if and only if `category` is `chargeback`.
     *
     * @param Chargeback|ChargebackShape $chargeback
     */
    public function withChargeback(Chargeback|array $chargeback): self
    {
        $self = clone $this;
        $self['chargeback'] = $chargeback;

        return $self;
    }

    /**
     * The merchant pre-arbitration decline details for the user submission. Required if and only if `category` is `merchant_prearbitration_decline`.
     *
     * @param MerchantPrearbitrationDecline|MerchantPrearbitrationDeclineShape $merchantPrearbitrationDecline
     */
    public function withMerchantPrearbitrationDecline(
        MerchantPrearbitrationDecline|array $merchantPrearbitrationDecline
    ): self {
        $self = clone $this;
        $self['merchantPrearbitrationDecline'] = $merchantPrearbitrationDecline;

        return $self;
    }

    /**
     * The user pre-arbitration details for the user submission. Required if and only if `category` is `user_prearbitration`.
     *
     * @param UserPrearbitration|UserPrearbitrationShape $userPrearbitration
     */
    public function withUserPrearbitration(
        UserPrearbitration|array $userPrearbitration
    ): self {
        $self = clone $this;
        $self['userPrearbitration'] = $userPrearbitration;

        return $self;
    }
}

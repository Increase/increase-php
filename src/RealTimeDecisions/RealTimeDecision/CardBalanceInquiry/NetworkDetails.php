<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry\NetworkDetails\Category;
use Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry\NetworkDetails\Pulse;
use Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry\NetworkDetails\Visa;

/**
 * Fields specific to the `network`.
 *
 * @phpstan-import-type PulseShape from \Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry\NetworkDetails\Pulse
 * @phpstan-import-type VisaShape from \Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry\NetworkDetails\Visa
 *
 * @phpstan-type NetworkDetailsShape = array{
 *   category: Category|value-of<Category>,
 *   pulse: null|Pulse|PulseShape,
 *   visa: null|Visa|VisaShape,
 * }
 */
final class NetworkDetails implements BaseModel
{
    /** @use SdkModel<NetworkDetailsShape> */
    use SdkModel;

    /**
     * The payment network used to process this card authorization.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * Fields specific to the `pulse` network.
     */
    #[Required]
    public ?Pulse $pulse;

    /**
     * Fields specific to the `visa` network.
     */
    #[Required]
    public ?Visa $visa;

    /**
     * `new NetworkDetails()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NetworkDetails::with(category: ..., pulse: ..., visa: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NetworkDetails)->withCategory(...)->withPulse(...)->withVisa(...)
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
     * @param Pulse|PulseShape|null $pulse
     * @param Visa|VisaShape|null $visa
     */
    public static function with(
        Category|string $category,
        Pulse|array|null $pulse,
        Visa|array|null $visa
    ): self {
        $self = new self;

        $self['category'] = $category;
        $self['pulse'] = $pulse;
        $self['visa'] = $visa;

        return $self;
    }

    /**
     * The payment network used to process this card authorization.
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
     * Fields specific to the `pulse` network.
     *
     * @param Pulse|PulseShape|null $pulse
     */
    public function withPulse(Pulse|array|null $pulse): self
    {
        $self = clone $this;
        $self['pulse'] = $pulse;

        return $self;
    }

    /**
     * Fields specific to the `visa` network.
     *
     * @param Visa|VisaShape|null $visa
     */
    public function withVisa(Visa|array|null $visa): self
    {
        $self = clone $this;
        $self['visa'] = $visa;

        return $self;
    }
}

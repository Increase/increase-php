<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityServices;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Ongoing negotiations. Exclude if there is no evidence of ongoing negotiations.
 *
 * @phpstan-type OngoingNegotiationsShape = array{
 *   explanation: string, issuerFirstNotifiedAt: string, startedAt: string
 * }
 */
final class OngoingNegotiations implements BaseModel
{
    /** @use SdkModel<OngoingNegotiationsShape> */
    use SdkModel;

    /**
     * Explanation of the previous ongoing negotiations between the cardholder and merchant.
     */
    #[Required]
    public string $explanation;

    /**
     * Date the cardholder first notified the issuer of the dispute.
     */
    #[Required('issuer_first_notified_at')]
    public string $issuerFirstNotifiedAt;

    /**
     * Started at.
     */
    #[Required('started_at')]
    public string $startedAt;

    /**
     * `new OngoingNegotiations()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OngoingNegotiations::with(
     *   explanation: ..., issuerFirstNotifiedAt: ..., startedAt: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OngoingNegotiations)
     *   ->withExplanation(...)
     *   ->withIssuerFirstNotifiedAt(...)
     *   ->withStartedAt(...)
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
     */
    public static function with(
        string $explanation,
        string $issuerFirstNotifiedAt,
        string $startedAt
    ): self {
        $self = new self;

        $self['explanation'] = $explanation;
        $self['issuerFirstNotifiedAt'] = $issuerFirstNotifiedAt;
        $self['startedAt'] = $startedAt;

        return $self;
    }

    /**
     * Explanation of the previous ongoing negotiations between the cardholder and merchant.
     */
    public function withExplanation(string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }

    /**
     * Date the cardholder first notified the issuer of the dispute.
     */
    public function withIssuerFirstNotifiedAt(
        string $issuerFirstNotifiedAt
    ): self {
        $self = clone $this;
        $self['issuerFirstNotifiedAt'] = $issuerFirstNotifiedAt;

        return $self;
    }

    /**
     * Started at.
     */
    public function withStartedAt(string $startedAt): self
    {
        $self = clone $this;
        $self['startedAt'] = $startedAt;

        return $self;
    }
}

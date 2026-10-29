<?php

declare(strict_types=1);

namespace Increase\WireDrawdownRequests\WireDrawdownRequest;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\WireDrawdownRequests\WireDrawdownRequest\Refusal\RefusalReasonCode;

/**
 * If the debtor refuses the drawdown request, this will contain supplemental details.
 *
 * @phpstan-type RefusalShape = array{
 *   refusalReasonAdditionalInformation: string|null,
 *   refusalReasonCode: RefusalReasonCode|value-of<RefusalReasonCode>,
 *   refusedAt: \DateTimeInterface,
 * }
 */
final class Refusal implements BaseModel
{
    /** @use SdkModel<RefusalShape> */
    use SdkModel;

    /**
     * Additional information about the refusal provided by the debtor bank. This is typically present when the `refusal_reason_code` is `narrative`.
     */
    #[Required('refusal_reason_additional_information')]
    public ?string $refusalReasonAdditionalInformation;

    /**
     * The reason the wire drawdown request was refused as provided by the debtor bank.
     *
     * @var value-of<RefusalReasonCode> $refusalReasonCode
     */
    #[Required('refusal_reason_code', enum: RefusalReasonCode::class)]
    public string $refusalReasonCode;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the wire drawdown request was refused.
     */
    #[Required('refused_at')]
    public \DateTimeInterface $refusedAt;

    /**
     * `new Refusal()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Refusal::with(
     *   refusalReasonAdditionalInformation: ...,
     *   refusalReasonCode: ...,
     *   refusedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Refusal)
     *   ->withRefusalReasonAdditionalInformation(...)
     *   ->withRefusalReasonCode(...)
     *   ->withRefusedAt(...)
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
     * @param RefusalReasonCode|value-of<RefusalReasonCode> $refusalReasonCode
     */
    public static function with(
        ?string $refusalReasonAdditionalInformation,
        RefusalReasonCode|string $refusalReasonCode,
        \DateTimeInterface $refusedAt,
    ): self {
        $self = new self;

        $self['refusalReasonAdditionalInformation'] = $refusalReasonAdditionalInformation;
        $self['refusalReasonCode'] = $refusalReasonCode;
        $self['refusedAt'] = $refusedAt;

        return $self;
    }

    /**
     * Additional information about the refusal provided by the debtor bank. This is typically present when the `refusal_reason_code` is `narrative`.
     */
    public function withRefusalReasonAdditionalInformation(
        ?string $refusalReasonAdditionalInformation
    ): self {
        $self = clone $this;
        $self['refusalReasonAdditionalInformation'] = $refusalReasonAdditionalInformation;

        return $self;
    }

    /**
     * The reason the wire drawdown request was refused as provided by the debtor bank.
     *
     * @param RefusalReasonCode|value-of<RefusalReasonCode> $refusalReasonCode
     */
    public function withRefusalReasonCode(
        RefusalReasonCode|string $refusalReasonCode
    ): self {
        $self = clone $this;
        $self['refusalReasonCode'] = $refusalReasonCode;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the wire drawdown request was refused.
     */
    public function withRefusedAt(\DateTimeInterface $refusedAt): self
    {
        $self = clone $this;
        $self['refusedAt'] = $refusedAt;

        return $self;
    }
}

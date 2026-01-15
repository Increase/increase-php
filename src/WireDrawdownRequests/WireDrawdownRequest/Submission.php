<?php

declare(strict_types=1);

namespace Increase\WireDrawdownRequests\WireDrawdownRequest;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * After the drawdown request is submitted to Fedwire, this will contain supplemental details.
 *
 * @phpstan-type SubmissionShape = array{inputMessageAccountabilityData: string}
 */
final class Submission implements BaseModel
{
    /** @use SdkModel<SubmissionShape> */
    use SdkModel;

    /**
     * The input message accountability data (IMAD) uniquely identifying the submission with Fedwire.
     */
    #[Required('input_message_accountability_data')]
    public string $inputMessageAccountabilityData;

    /**
     * `new Submission()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Submission::with(inputMessageAccountabilityData: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Submission)->withInputMessageAccountabilityData(...)
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
    public static function with(string $inputMessageAccountabilityData): self
    {
        $self = new self;

        $self['inputMessageAccountabilityData'] = $inputMessageAccountabilityData;

        return $self;
    }

    /**
     * The input message accountability data (IMAD) uniquely identifying the submission with Fedwire.
     */
    public function withInputMessageAccountabilityData(
        string $inputMessageAccountabilityData
    ): self {
        $self = clone $this;
        $self['inputMessageAccountabilityData'] = $inputMessageAccountabilityData;

        return $self;
    }
}

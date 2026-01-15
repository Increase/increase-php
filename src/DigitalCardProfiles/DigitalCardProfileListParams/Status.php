<?php

declare(strict_types=1);

namespace Increase\DigitalCardProfiles\DigitalCardProfileListParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DigitalCardProfiles\DigitalCardProfileListParams\Status\In;

/**
 * @phpstan-type StatusShape = array{in?: list<In|value-of<In>>|null}
 */
final class Status implements BaseModel
{
    /** @use SdkModel<StatusShape> */
    use SdkModel;

    /**
     * Filter Digital Card Profiles for those with the specified digital wallet status or statuses. For GET requests, this should be encoded as a comma-delimited string, such as `?in=one,two,three`.
     *
     * @var list<value-of<In>>|null $in
     */
    #[Optional(list: In::class)]
    public ?array $in;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<In|value-of<In>>|null $in
     */
    public static function with(?array $in = null): self
    {
        $self = new self;

        null !== $in && $self['in'] = $in;

        return $self;
    }

    /**
     * Filter Digital Card Profiles for those with the specified digital wallet status or statuses. For GET requests, this should be encoded as a comma-delimited string, such as `?in=one,two,three`.
     *
     * @param list<In|value-of<In>> $in
     */
    public function withIn(array $in): self
    {
        $self = clone $this;
        $self['in'] = $in;

        return $self;
    }
}

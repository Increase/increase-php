<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams\EntityCsv;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Exports\ExportCreateParams\EntityCsv\Status\In;

/**
 * Entity statuses to filter by.
 *
 * @phpstan-type StatusShape = array{in: list<In|value-of<In>>}
 */
final class Status implements BaseModel
{
    /** @use SdkModel<StatusShape> */
    use SdkModel;

    /**
     * Entity statuses to filter by. For GET requests, this should be encoded as a comma-delimited string, such as `?in=one,two,three`.
     *
     * @var list<value-of<In>> $in
     */
    #[Required(list: In::class)]
    public array $in;

    /**
     * `new Status()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Status::with(in: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Status)->withIn(...)
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
     * @param list<In|value-of<In>> $in
     */
    public static function with(array $in): self
    {
        $self = new self;

        $self['in'] = $in;

        return $self;
    }

    /**
     * Entity statuses to filter by. For GET requests, this should be encoded as a comma-delimited string, such as `?in=one,two,three`.
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

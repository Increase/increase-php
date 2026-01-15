<?php

declare(strict_types=1);

namespace Increase\Entities;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Update the industry code for a corporate Entity.
 *
 * @see Increase\Services\EntitiesService::updateIndustryCode()
 *
 * @phpstan-type EntityUpdateIndustryCodeParamsShape = array{industryCode: string}
 */
final class EntityUpdateIndustryCodeParams implements BaseModel
{
    /** @use SdkModel<EntityUpdateIndustryCodeParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The North American Industry Classification System (NAICS) code for the corporation's primary line of business. This is a number, like `5132` for `Software Publishers`. A full list of classification codes is available [here](https://increase.com/documentation/data-dictionary#north-american-industry-classification-system-codes).
     */
    #[Required('industry_code')]
    public string $industryCode;

    /**
     * `new EntityUpdateIndustryCodeParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntityUpdateIndustryCodeParams::with(industryCode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntityUpdateIndustryCodeParams)->withIndustryCode(...)
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
    public static function with(string $industryCode): self
    {
        $self = new self;

        $self['industryCode'] = $industryCode;

        return $self;
    }

    /**
     * The North American Industry Classification System (NAICS) code for the corporation's primary line of business. This is a number, like `5132` for `Software Publishers`. A full list of classification codes is available [here](https://increase.com/documentation/data-dictionary#north-american-industry-classification-system-codes).
     */
    public function withIndustryCode(string $industryCode): self
    {
        $self = clone $this;
        $self['industryCode'] = $industryCode;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\PhysicalCardProfiles\PhysicalCardProfile;
use Increase\PhysicalCardProfiles\PhysicalCardProfileCloneParams;
use Increase\PhysicalCardProfiles\PhysicalCardProfileCreateParams;
use Increase\PhysicalCardProfiles\PhysicalCardProfileCreateParams\FrontText;
use Increase\PhysicalCardProfiles\PhysicalCardProfileListParams;
use Increase\PhysicalCardProfiles\PhysicalCardProfileListParams\Status;
use Increase\RequestOptions;
use Increase\ServiceContracts\PhysicalCardProfilesRawContract;

/**
 * @phpstan-import-type FrontTextShape from \Increase\PhysicalCardProfiles\PhysicalCardProfileCreateParams\FrontText
 * @phpstan-import-type StatusShape from \Increase\PhysicalCardProfiles\PhysicalCardProfileListParams\Status
 * @phpstan-import-type FrontTextShape from \Increase\PhysicalCardProfiles\PhysicalCardProfileCloneParams\FrontText as FrontTextShape1
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class PhysicalCardProfilesRawService implements PhysicalCardProfilesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Physical Card Profile
     *
     * @param array{
     *   carrierImageFileID: string,
     *   contactPhone: string,
     *   description: string,
     *   frontImageFileID: string,
     *   programID: string,
     *   frontText?: FrontText|FrontTextShape,
     * }|PhysicalCardProfileCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCardProfile>
     *
     * @throws APIException
     */
    public function create(
        array|PhysicalCardProfileCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PhysicalCardProfileCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'physical_card_profiles',
            body: (object) $parsed,
            options: $options,
            convert: PhysicalCardProfile::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Card Profile
     *
     * @param string $physicalCardProfileID the identifier of the Card Profile
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCardProfile>
     *
     * @throws APIException
     */
    public function retrieve(
        string $physicalCardProfileID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['physical_card_profiles/%1$s', $physicalCardProfileID],
            options: $requestOptions,
            convert: PhysicalCardProfile::class,
        );
    }

    /**
     * @api
     *
     * List Physical Card Profiles
     *
     * @param array{
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|PhysicalCardProfileListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<PhysicalCardProfile>>
     *
     * @throws APIException
     */
    public function list(
        array|PhysicalCardProfileListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PhysicalCardProfileListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'physical_card_profiles',
            query: Util::array_transform_keys(
                $parsed,
                ['idempotencyKey' => 'idempotency_key']
            ),
            options: $options,
            convert: PhysicalCardProfile::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Archive a Physical Card Profile
     *
     * @param string $physicalCardProfileID the identifier of the Physical Card Profile to archive
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCardProfile>
     *
     * @throws APIException
     */
    public function archive(
        string $physicalCardProfileID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['physical_card_profiles/%1$s/archive', $physicalCardProfileID],
            options: $requestOptions,
            convert: PhysicalCardProfile::class,
        );
    }

    /**
     * @api
     *
     * Clone a Physical Card Profile
     *
     * @param string $physicalCardProfileID the identifier of the Physical Card Profile to clone
     * @param array{
     *   carrierImageFileID?: string,
     *   contactPhone?: string,
     *   description?: string,
     *   frontImageFileID?: string,
     *   frontText?: PhysicalCardProfileCloneParams\FrontText|FrontTextShape1,
     *   programID?: string,
     * }|PhysicalCardProfileCloneParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCardProfile>
     *
     * @throws APIException
     */
    public function clone(
        string $physicalCardProfileID,
        array|PhysicalCardProfileCloneParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PhysicalCardProfileCloneParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['physical_card_profiles/%1$s/clone', $physicalCardProfileID],
            body: (object) $parsed,
            options: $options,
            convert: PhysicalCardProfile::class,
        );
    }
}

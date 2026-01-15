<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\DigitalCardProfiles\DigitalCardProfile;
use Increase\DigitalCardProfiles\DigitalCardProfileCloneParams;
use Increase\DigitalCardProfiles\DigitalCardProfileCreateParams;
use Increase\DigitalCardProfiles\DigitalCardProfileCreateParams\TextColor;
use Increase\DigitalCardProfiles\DigitalCardProfileListParams;
use Increase\DigitalCardProfiles\DigitalCardProfileListParams\Status;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\DigitalCardProfilesRawContract;

/**
 * @phpstan-import-type TextColorShape from \Increase\DigitalCardProfiles\DigitalCardProfileCreateParams\TextColor
 * @phpstan-import-type StatusShape from \Increase\DigitalCardProfiles\DigitalCardProfileListParams\Status
 * @phpstan-import-type TextColorShape from \Increase\DigitalCardProfiles\DigitalCardProfileCloneParams\TextColor as TextColorShape1
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class DigitalCardProfilesRawService implements DigitalCardProfilesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Digital Card Profile
     *
     * @param array{
     *   appIconFileID: string,
     *   backgroundImageFileID: string,
     *   cardDescription: string,
     *   description: string,
     *   issuerName: string,
     *   contactEmail?: string,
     *   contactPhone?: string,
     *   contactWebsite?: string,
     *   textColor?: TextColor|TextColorShape,
     * }|DigitalCardProfileCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DigitalCardProfile>
     *
     * @throws APIException
     */
    public function create(
        array|DigitalCardProfileCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DigitalCardProfileCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'digital_card_profiles',
            body: (object) $parsed,
            options: $options,
            convert: DigitalCardProfile::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Digital Card Profile
     *
     * @param string $digitalCardProfileID the identifier of the Digital Card Profile
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DigitalCardProfile>
     *
     * @throws APIException
     */
    public function retrieve(
        string $digitalCardProfileID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['digital_card_profiles/%1$s', $digitalCardProfileID],
            options: $requestOptions,
            convert: DigitalCardProfile::class,
        );
    }

    /**
     * @api
     *
     * List Card Profiles
     *
     * @param array{
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|DigitalCardProfileListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<DigitalCardProfile>>
     *
     * @throws APIException
     */
    public function list(
        array|DigitalCardProfileListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DigitalCardProfileListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'digital_card_profiles',
            query: Util::array_transform_keys(
                $parsed,
                ['idempotencyKey' => 'idempotency_key']
            ),
            options: $options,
            convert: DigitalCardProfile::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Archive a Digital Card Profile
     *
     * @param string $digitalCardProfileID the identifier of the Digital Card Profile to archive
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DigitalCardProfile>
     *
     * @throws APIException
     */
    public function archive(
        string $digitalCardProfileID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['digital_card_profiles/%1$s/archive', $digitalCardProfileID],
            options: $requestOptions,
            convert: DigitalCardProfile::class,
        );
    }

    /**
     * @api
     *
     * Clones a Digital Card Profile
     *
     * @param string $digitalCardProfileID the identifier of the Digital Card Profile to clone
     * @param array{
     *   appIconFileID?: string,
     *   backgroundImageFileID?: string,
     *   cardDescription?: string,
     *   contactEmail?: string,
     *   contactPhone?: string,
     *   contactWebsite?: string,
     *   description?: string,
     *   issuerName?: string,
     *   textColor?: DigitalCardProfileCloneParams\TextColor|TextColorShape1,
     * }|DigitalCardProfileCloneParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DigitalCardProfile>
     *
     * @throws APIException
     */
    public function clone(
        string $digitalCardProfileID,
        array|DigitalCardProfileCloneParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DigitalCardProfileCloneParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['digital_card_profiles/%1$s/clone', $digitalCardProfileID],
            body: (object) $parsed,
            options: $options,
            convert: DigitalCardProfile::class,
        );
    }
}

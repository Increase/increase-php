<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\PhysicalCardProfiles\PhysicalCardProfile;
use Increase\PhysicalCardProfiles\PhysicalCardProfileCreateParams\FrontText;
use Increase\PhysicalCardProfiles\PhysicalCardProfileListParams\Status;
use Increase\RequestOptions;
use Increase\ServiceContracts\PhysicalCardProfilesContract;

/**
 * @phpstan-import-type FrontTextShape from \Increase\PhysicalCardProfiles\PhysicalCardProfileCreateParams\FrontText
 * @phpstan-import-type StatusShape from \Increase\PhysicalCardProfiles\PhysicalCardProfileListParams\Status
 * @phpstan-import-type FrontTextShape from \Increase\PhysicalCardProfiles\PhysicalCardProfileCloneParams\FrontText as FrontTextShape1
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class PhysicalCardProfilesService implements PhysicalCardProfilesContract
{
    /**
     * @api
     */
    public PhysicalCardProfilesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PhysicalCardProfilesRawService($client);
    }

    /**
     * @api
     *
     * Create a Physical Card Profile
     *
     * @param string $carrierImageFileID the identifier of the File containing the physical card's carrier image
     * @param string $contactPhone a phone number the user can contact to receive support for their card
     * @param string $description a description you can use to identify the Card Profile
     * @param string $frontImageFileID the identifier of the File containing the physical card's front image
     * @param string $programID the identifier for the Program that this Physical Card Profile falls under
     * @param FrontText|FrontTextShape $frontText Text printed on the front of the card. Reach out to [support@increase.com](mailto:support@increase.com) for more information.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $carrierImageFileID,
        string $contactPhone,
        string $description,
        string $frontImageFileID,
        string $programID,
        FrontText|array|null $frontText = null,
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCardProfile {
        $params = Util::removeNulls(
            [
                'carrierImageFileID' => $carrierImageFileID,
                'contactPhone' => $contactPhone,
                'description' => $description,
                'frontImageFileID' => $frontImageFileID,
                'programID' => $programID,
                'frontText' => $frontText,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Card Profile
     *
     * @param string $physicalCardProfileID the identifier of the Card Profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $physicalCardProfileID,
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCardProfile {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($physicalCardProfileID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Physical Card Profiles
     *
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<PhysicalCardProfile>
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'cursor' => $cursor,
                'idempotencyKey' => $idempotencyKey,
                'limit' => $limit,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Archive a Physical Card Profile
     *
     * @param string $physicalCardProfileID the identifier of the Physical Card Profile to archive
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $physicalCardProfileID,
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCardProfile {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($physicalCardProfileID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Clone a Physical Card Profile
     *
     * @param string $physicalCardProfileID the identifier of the Physical Card Profile to clone
     * @param string $carrierImageFileID the identifier of the File containing the physical card's carrier image
     * @param string $contactPhone a phone number the user can contact to receive support for their card
     * @param string $description a description you can use to identify the Card Profile
     * @param string $frontImageFileID the identifier of the File containing the physical card's front image
     * @param \Increase\PhysicalCardProfiles\PhysicalCardProfileCloneParams\FrontText|FrontTextShape1 $frontText Text printed on the front of the card. Reach out to [support@increase.com](mailto:support@increase.com) for more information.
     * @param string $programID the identifier of the Program to use for the cloned Physical Card Profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function clone(
        string $physicalCardProfileID,
        ?string $carrierImageFileID = null,
        ?string $contactPhone = null,
        ?string $description = null,
        ?string $frontImageFileID = null,
        \Increase\PhysicalCardProfiles\PhysicalCardProfileCloneParams\FrontText|array|null $frontText = null,
        ?string $programID = null,
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCardProfile {
        $params = Util::removeNulls(
            [
                'carrierImageFileID' => $carrierImageFileID,
                'contactPhone' => $contactPhone,
                'description' => $description,
                'frontImageFileID' => $frontImageFileID,
                'frontText' => $frontText,
                'programID' => $programID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->clone($physicalCardProfileID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

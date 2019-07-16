<?php

namespace FondOfSpryker\Glue\BrandCompanyUsersRestApi\Processor\Expander;

use FondOfSpryker\Glue\BrandCompanyUsersRestApi\BrandCompanyUsersRestApiConfig;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestBrandsResponseAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class BrandsCompanyUsersResourceRelationshipExpander implements BrandsCompanyUsersResourceRelationshipExpanderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(RestResourceBuilderInterface $restResourceBuilder)
    {
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[] $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return void
     */
    public function addResourceRelationships(array $resources, RestRequestInterface $restRequest): void
    {
        foreach ($resources as $resource) {
            $payload = $resource->getPayload();

            if ($payload === null || !($payload instanceof CompanyUserTransfer)) {
                continue;
            }

            $companyTransfer = $payload->getCompany();

            if ($companyTransfer === null) {
                continue;
            }

            $brandRelationTransfer = $companyTransfer->getBrandRelation();

            if ($brandRelationTransfer === null) {
                continue;
            }

            foreach ($brandRelationTransfer->getBrands() as $brandTransfer) {
                $restBrandsResponseAttributesTransfer = (new RestBrandsResponseAttributesTransfer())->fromArray(
                    $brandTransfer->toArray(),
                    true
                );

                $brandResource = $this->restResourceBuilder->createRestResource(
                    BrandCompanyUsersRestApiConfig::RESOURCE_BRANDS,
                    $brandTransfer->getUuid(),
                    $restBrandsResponseAttributesTransfer
                );

                $resource->addRelationship($brandResource);
            }
        }
    }
}

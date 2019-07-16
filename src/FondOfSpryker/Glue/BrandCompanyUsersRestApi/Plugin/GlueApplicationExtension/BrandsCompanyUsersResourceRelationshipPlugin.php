<?php

namespace FondOfSpryker\Glue\BrandCompanyUsersRestApi\Plugin\GlueApplicationExtension;

use FondOfSpryker\Glue\BrandCompanyUsersRestApi\BrandCompanyUsersRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRelationshipPluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method \FondOfSpryker\Glue\BrandCompanyUsersRestApi\BrandCompanyUsersRestApiFactory getFactory()
 */
class BrandsCompanyUsersResourceRelationshipPlugin extends AbstractPlugin implements ResourceRelationshipPluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[] $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return void
     * @api
     *
     * {@inheritdoc}
     *
     */
    public function addResourceRelationships(array $resources, RestRequestInterface $restRequest): void
    {
        $this->getFactory()->createBrandsCompanyUsersResourceRelationshipExpander()
            ->addResourceRelationships($resources, $restRequest);
    }

    /**
     * @return string
     * @api
     *
     * {@inheritdoc}
     *
     */
    public function getRelationshipResourceType(): string
    {
        return BrandCompanyUsersRestApiConfig::RESOURCE_BRANDS;
    }
}

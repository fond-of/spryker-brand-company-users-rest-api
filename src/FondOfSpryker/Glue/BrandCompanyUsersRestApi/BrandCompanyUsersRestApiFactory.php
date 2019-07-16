<?php

namespace FondOfSpryker\Glue\BrandCompanyUsersRestApi;

use FondOfSpryker\Glue\BrandCompanyUsersRestApi\Processor\Expander\BrandsCompanyUsersResourceRelationshipExpander;
use FondOfSpryker\Glue\BrandCompanyUsersRestApi\Processor\Expander\BrandsCompanyUsersResourceRelationshipExpanderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class BrandCompanyUsersRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\BrandCompanyUsersRestApi\Processor\Expander\BrandsCompanyUsersResourceRelationshipExpanderInterface
     */
    public function createBrandsCompanyUsersResourceRelationshipExpander(): BrandsCompanyUsersResourceRelationshipExpanderInterface
    {
        return new BrandsCompanyUsersResourceRelationshipExpander($this->getResourceBuilder());
    }
}

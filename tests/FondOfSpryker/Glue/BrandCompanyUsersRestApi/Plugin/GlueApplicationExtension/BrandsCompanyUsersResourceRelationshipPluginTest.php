<?php

namespace FondOfSpryker\Glue\BrandCompanyUsersRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\BrandCompanyUsersRestApi\BrandCompanyUsersRestApiConfig;

class BrandsCompanyUsersResourceRelationshipPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\BrandCompanyUsersRestApi\Plugin\GlueApplicationExtension\BrandsCompanyUsersResourceRelationshipPlugin
     */
    protected $brandsCompanyUsersResourceRelationshipPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->brandsCompanyUsersResourceRelationshipPlugin = new BrandsCompanyUsersResourceRelationshipPlugin();
    }

    /**
     * @return void
     */
    public function testGetRelationshipResourceType(): void
    {
        $this->assertSame(BrandCompanyUsersRestApiConfig::RESOURCE_BRANDS, $this->brandsCompanyUsersResourceRelationshipPlugin->getRelationshipResourceType());
    }
}

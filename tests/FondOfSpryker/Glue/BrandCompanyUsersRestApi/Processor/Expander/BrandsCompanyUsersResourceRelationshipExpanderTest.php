<?php

namespace FondOfSpryker\Glue\BrandCompanyUsersRestApi\Processor\Expander;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class BrandsCompanyUsersResourceRelationshipExpanderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\BrandCompanyUsersRestApi\Processor\Expander\BrandsCompanyUsersResourceRelationshipExpander
     */
    protected $brandsCompanyUsersResourceRelationshipExpander;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var array
     */
    protected $resources;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBrandRelationTransfer
     */
    protected $companyBrandRelationTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandTransfer
     */
    protected $brandTransferMock;

    /**
     * @var \ArrayObject
     */
    protected $brandTransferMocks;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResourceBuilderInterfaceMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceInterfaceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resources = [
            $this->restResourceInterfaceMock,
        ];

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBrandRelationTransferMock = $this->getMockBuilder(CompanyBrandRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandTransferMock = $this->getMockBuilder(BrandTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandTransferMocks = new ArrayObject([
            $this->brandTransferMock,
        ]);

        $this->uuid = "uuid";

        $this->brandsCompanyUsersResourceRelationshipExpander = new BrandsCompanyUsersResourceRelationshipExpander(
            $this->restResourceBuilderInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationships(): void
    {
        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('getBrandRelation')
            ->willReturn($this->companyBrandRelationTransferMock);

        $this->companyBrandRelationTransferMock->expects($this->atLeastOnce())
            ->method('getBrands')
            ->willReturn($this->brandTransferMocks);

        $this->brandTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->brandTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->brandsCompanyUsersResourceRelationshipExpander->addResourceRelationships(
            $this->resources,
            $this->restRequestInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationshipsBrandRelationNull(): void
    {
        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        $this->brandsCompanyUsersResourceRelationshipExpander->addResourceRelationships(
            $this->resources,
            $this->restRequestInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationshipsCompanyNull(): void
    {
        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->companyUserTransferMock);

        $this->brandsCompanyUsersResourceRelationshipExpander->addResourceRelationships(
            $this->resources,
            $this->restRequestInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationshipsPayLoadNull(): void
    {
        $this->brandsCompanyUsersResourceRelationshipExpander->addResourceRelationships(
            $this->resources,
            $this->restRequestInterfaceMock
        );
    }
}

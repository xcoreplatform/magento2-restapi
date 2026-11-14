<?php
declare(strict_types=1);

namespace Dealer4dealer\Xcore\Test\Unit\Setup;

use Dealer4dealer\Xcore\Setup\Uninstall;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Tax\Api\Data\TaxClassInterface;
use Magento\Tax\Api\Data\TaxClassSearchResultsInterface;
use Magento\Tax\Model\ClassModel;
use Magento\Tax\Model\TaxClass\Repository as TaxClassRepository;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class UninstallTest extends TestCase
{
    public function testRemoveTaxClassesLooksUpCurrentAndLegacyClassNamesOfCustomerType(): void
    {
        $filters = [];
        $uninstall = $this->createUninstall(
            $this->createBuilder($filters),
            $this->createRepository(static fn (): array => [])
        );

        $this->invokeRemoveTaxClasses($uninstall);

        $this->assertEqualsCanonicalizing(
            [
                ['class_name', 'xCore Excluding VAT'],
                ['class_type', ClassModel::TAX_CLASS_TYPE_CUSTOMER],
                ['class_name', 'xCore Including VAT'],
                ['class_type', ClassModel::TAX_CLASS_TYPE_CUSTOMER],
                ['class_name', 'xCore Without VAT'],
                ['class_type', ClassModel::TAX_CLASS_TYPE_CUSTOMER],
                ['class_name', 'xCore With VAT'],
                ['class_type', ClassModel::TAX_CLASS_TYPE_CUSTOMER],
            ],
            $filters
        );
    }

    public function testRemoveTaxClassesDeletesMatchingClass(): void
    {
        $filters = [];
        $taxClass = $this->createStub(TaxClassInterface::class);
        $repository = $this->createRepository(
            static fn (int $call): array => $call === 0 ? [$taxClass] : []
        );
        $repository->expects($this->once())->method('delete')->with($taxClass);

        $this->invokeRemoveTaxClasses($this->createUninstall($this->createBuilder($filters), $repository));
    }

    public function testRemoveTaxClassesSkipsAndLogsClassInUse(): void
    {
        $filters = [];
        $inUse = $this->createStub(TaxClassInterface::class);
        $free = $this->createStub(TaxClassInterface::class);
        $repository = $this->createRepository(
            static function (int $call) use ($inUse, $free): array {
                return [0 => [$inUse], 1 => [$free]][$call] ?? [];
            }
        );
        $deleted = [];
        $repository->method('delete')->willReturnCallback(
            static function ($class) use ($inUse, &$deleted): bool {
                if ($class === $inUse) {
                    throw new CouldNotDeleteException(__('Tax class is in use'));
                }
                $deleted[] = $class;
                return true;
            }
        );
        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())->method('warning')->with(
            'Tax class was not removed on uninstall.',
            $this->callback(
                static fn (array $context): bool => $context['tax_class'] === 'xCore Excluding VAT'
                    && $context['exception'] instanceof CouldNotDeleteException
            )
        );

        $this->invokeRemoveTaxClasses(
            $this->createUninstall($this->createBuilder($filters), $repository, $logger)
        );

        $this->assertSame([$free], $deleted);
    }

    private function createBuilder(array &$filters): SearchCriteriaBuilder
    {
        $builder = $this->createMock(SearchCriteriaBuilder::class);
        $builder->method('setFilterGroups')->willReturnSelf();
        $builder->method('addFilter')->willReturnCallback(
            function ($field, $value) use (&$filters, $builder) {
                $filters[] = [$field, $value];
                return $builder;
            }
        );
        $builder->method('create')->willReturn($this->createStub(SearchCriteriaInterface::class));

        return $builder;
    }

    private function createRepository(callable $itemsPerCall): TaxClassRepository
    {
        $call = 0;
        $repository = $this->createMock(TaxClassRepository::class);
        $repository->method('getList')->willReturnCallback(
            function () use (&$call, $itemsPerCall) {
                $results = $this->createStub(TaxClassSearchResultsInterface::class);
                $results->method('getItems')->willReturn($itemsPerCall($call++));
                return $results;
            }
        );

        return $repository;
    }

    private function createUninstall(
        SearchCriteriaBuilder $builder,
        TaxClassRepository $repository,
        ?LoggerInterface $logger = null
    ): Uninstall {
        return new Uninstall(
            $builder,
            $repository,
            $this->createStub(EavSetupFactory::class),
            $logger ?? $this->createStub(LoggerInterface::class)
        );
    }

    private function invokeRemoveTaxClasses(Uninstall $uninstall): void
    {
        $method = new \ReflectionMethod(Uninstall::class, 'removeTaxClasses');
        if (PHP_VERSION_ID < 80100) {
            $method->setAccessible(true);
        }
        $method->invoke($uninstall);
    }
}

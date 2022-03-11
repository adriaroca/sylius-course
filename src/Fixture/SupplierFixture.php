<?php

namespace App\Fixture;

use App\Entity\Supplier\SupplierInterface;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Generator;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Sylius\Bundle\FixturesBundle\Fixture\FixtureInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class SupplierFixture extends AbstractFixture implements FixtureInterface
{
    private FactoryInterface $supplierFactory;
    private EntityManagerInterface $supplierManager;
    private Generator $generator;

    /**
     * @param FactoryInterface $supplierFactory
     * @param EntityManagerInterface $supplierManager
     * @param Generator $generator
     */
    public function __construct(FactoryInterface $supplierFactory, EntityManagerInterface $supplierManager, Generator $generator)
    {
        $this->supplierFactory = $supplierFactory;
        $this->supplierManager = $supplierManager;
        $this->generator = $generator;
    }

    public function load(array $options): void
    {
        for($i = 0; $i < $options['count']; $i++) {
            /** @var SupplierInterface $fakeSupplier */
            $fakeSupplier = $this->supplierFactory->createNew();
            $fakeSupplier->setName($this->generator->company);
            $fakeSupplier->setEmail($this->generator->companyEmail);

            $this->supplierManager->persist($fakeSupplier);
        }

        $this->supplierManager->flush();
    }

    public function getName(): string
    {
        return 'supplier';
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode->children()->integerNode('count')->defaultValue(10);
    }
}

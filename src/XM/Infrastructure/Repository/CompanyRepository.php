<?php

namespace App\XM\Infrastructure\Repository;

use App\XM\Domain\Entity\Company;
use App\XM\Domain\Interfaces\CompanyRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Company>
 *
 * @inheritdoc
 */
class CompanyRepository extends ServiceEntityRepository implements CompanyRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    public function add(Company $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Company $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }

    public function findBySymbol(string $symbol): ?Company
    {
        return $this->findOneBy(['symbol' => $symbol]);
    }

    public function getSymbols(): array
    {
        return $this
           ->createQueryBuilder('c')
           ->select('c.symbol')
           ->getQuery()
           ->getSingleColumnResult()
        ;
    }
}

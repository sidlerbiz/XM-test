<?php

namespace App\XM\Domain\Interfaces;

use App\XM\Domain\Entity\Company;

/**
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface CompanyRepositoryInterface
{
    public function add(Company $entity, bool $flush = false): void;
    public function remove(Company $entity, bool $flush = false): void;
    public function flush(): void;
    public function findBySymbol(string $symbol): ?Company;
}
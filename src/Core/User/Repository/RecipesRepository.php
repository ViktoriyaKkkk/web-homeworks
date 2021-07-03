<?php

declare(strict_types=1);

namespace App\Core\User\Repository;


use App\Core\Common\Repository\AbstractRepository;
use App\Core\User\Document\Recipes;
use Doctrine\ODM\MongoDB\LockException;
use Doctrine\ODM\MongoDB\Mapping\MappingException;

/**
 * @method Recipes save(Recipes $user)
 * @method Recipes|null find(string $id)
 * @method Recipes|null findOneBy(array $criteria)
 * @method Recipes getOne(string $id)
 */
class RecipesRepository extends AbstractRepository
{
    public function getDocumentClassName(): string
    {
        return Recipes::class;
    }

    /**
     * @throws LockException
     * @throws MappingException|MappingException
     */
    public function getRecipesById(string $id): ?Recipes
    {
        return $this->find($id);
    }
}

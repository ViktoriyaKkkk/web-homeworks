<?php

declare(strict_types=1);

namespace App\Core\User\Document;

use App\Core\Common\Document\AbstractDocument;
use App\Core\User\Repository\RecipesRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceOne;

/**
 * @MongoDB\Document(repositoryClass=RecipesRepository::class, collection="recipes")
 */
class Recipes extends AbstractDocument
{
    /**
     * @MongoDB\Id
     */
    protected ?string $id = null;

    /**
     * @MongoDB\Field(type="string")
     */
    protected string $title;

    /**
     * @MongoDB\Field(type="string")
     */
    protected string $description;

    /**
     * @MongoDB\Field(type="string")
     */
    protected string $calories;

    /**
     * @MongoDB\Field(type="string")
     */
    protected string $weight;
    public function __construct(string $title, string $description, string $weight, string $calories)
    {
        $this->title = $title;
        $this->description  = $description;
        $this->calories = $calories;
        $this->weight  = $weight;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCalories(): string
    {
        return $this->calories;
    }

    public function getWeight(): string
    {
        return $this->weight;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function setCalories(?string $calories): void
    {
        $this->calories = $calories;
    }

    public function setWeight(?string $weight): void
    {
        $this->weight = $weight;
    }
}

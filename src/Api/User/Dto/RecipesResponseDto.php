<?php

declare(strict_types=1);

namespace App\Api\User\Dto;


class RecipesResponseDto
{
    public ?string $id;

    public ?string $title;

    public ?string $description;

    public string $calories;

    public ?string $weight;
}

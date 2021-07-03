<?php

declare(strict_types=1);

namespace App\Api\User\Dto;

class RecipesListResponseDto
{
    public array $data;

    public function __construct(RecipesResponseDto ... $data)
    {
        $this->data = $data;
    }
}

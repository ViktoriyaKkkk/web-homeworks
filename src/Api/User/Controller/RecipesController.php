<?php

declare(strict_types=1);

namespace App\Api\User\Controller;

use App\Api\User\Dto\RecipesCreateRequestDto;
use App\Api\User\Dto\RecipesListResponseDto;
use App\Api\User\Dto\RecipesResponseDto;
use App\Api\User\Dto\RecipesUpdateRequestDto;
use App\Api\User\Dto\ValidationExampleRequestDto;
use App\Core\Common\Dto\ValidationFailedResponse;
use App\Core\User\Document\Recipes;
use App\Core\User\Enum\Permission;
use App\Core\User\Enum\Role;
use App\Core\User\Enum\RoleHumanReadable;
use App\Core\User\Repository\RecipesRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * @Route("/recipes")
 */
class RecipesController extends AbstractController
{
    /**
     * @Route(path="", methods={"GET"})
     * @IsGranted(Permission::RECIPES_INDEX)
     * @Rest\View()
     *
     * @return RecipesListResponseDto|ValidationFailedResponse
     */
    public function index(
        Request $request,
        RecipesRepository $recipeRepository
    ): RecipesListResponseDto {
        $page     = (int)$request->get('page');
        $quantity = (int)$request->get('slice');

        $recipes = $recipeRepository->findBy([], [], $quantity, $quantity * ($page - 1));

        return new RecipesListResponseDto(
            ... array_map(
                    function (Recipes $recipe) {
                        return $this->createRecipesResponse($recipe);
                    },
                    $recipes
                )
        );
    }

    /**
     * @Route(path="", methods={"POST"})
     * @IsGranted(Permission::RECIPES_CREATE)
     * @ParamConverter("requestDto", converter="fos_rest.request_body")
     *
     * @Rest\View(statusCode=201)
     *
     * @param RecipesCreateRequestDto             $requestDto
     * @param ConstraintViolationListInterface $validationErrors
     * @param RecipesRepository                   $recipeRepository
     *
     * @return RecipesResponseDto|ValidationFailedResponse|Response
     */
    public function create(
        RecipesCreateRequestDto $requestDto,
        ConstraintViolationListInterface $validationErrors,
        RecipesRepository $recipeRepository
    ) {
        if ($validationErrors->count() > 0) {
            return new ValidationFailedResponse($validationErrors);
        }

        if ($recipe = $recipeRepository->findOneBy(['title' => $requestDto->title])) {
            return new Response('Recipes already exists', Response::HTTP_BAD_REQUEST);
        }

        $recipe = new Recipes(
            $requestDto->title,
            $requestDto->description,
            $requestDto->weight,
            $requestDto->calories
        );
        $recipe->setTitle($requestDto->title);
        $recipe->setDescription($requestDto->description);

        $recipeRepository->save($recipe);

        return $this->createRecipesResponse($recipe);
    }

    /**
     * @Route(path="/{id<%app.mongo_id_regexp%>}", methods={"PUT"})
     * @IsGranted(Permission::RECIPES_UPDATE)
     * @ParamConverter("recipe")
     * @ParamConverter("requestDto", converter="fos_rest.request_body")
     *
     * @Rest\View()
     *
     * @param RecipesUpdateRequestDto             $requestDto
     * @param ConstraintViolationListInterface $validationErrors
     * @param RecipesRepository                   $recipeRepository
     *
     * @return RecipesResponseDto|ValidationFailedResponse|Response
     */
    public function update(
        Recipes $recipe = null,
        RecipesUpdateRequestDto $requestDto,
        ConstraintViolationListInterface $validationErrors,
        RecipesRepository $recipeRepository
    ) {
        if (!$recipe) {
            throw $this->createNotFoundException('Recipes not found');
        }

        if ($validationErrors->count() > 0) {
            return new ValidationFailedResponse($validationErrors);
        }

        $recipe->setTitle($requestDto->title);
        $recipe->setDescription($requestDto->description);
        $recipe->setCalories($requestDto->calories);
        $recipe->setWeight($requestDto->weight);

        $recipeRepository->save($recipe);

        return $this->createRecipesResponse($recipe);
    }

    /**
     * @Route(path="/validation", methods={"POST"})
     * @IsGranted(Permission::RECIPES_VALIDATION)
     * @ParamConverter("requestDto", converter="fos_rest.request_body")
     *
     * @Rest\View()
     *
     * @return ValidationExampleRequestDto|ValidationFailedResponse
     */
    public function validation(
        ValidationExampleRequestDto $requestDto,
        ConstraintViolationListInterface $validationErrors
    ) {
        if ($validationErrors->count() > 0) {
            return new ValidationFailedResponse($validationErrors);
        }

        return $requestDto;
    }

    /**
     * @param Recipes         $recipe
     * @param Recipes|null $recipes
     *
     * @return RecipesResponseDto
     */
    private function createRecipesResponse(Recipes $recipe, ?Recipes $recipes = null): RecipesResponseDto
    {
        $dto = new RecipesResponseDto();

        $dto->id                = $recipe->getId();
        $dto->title         = $recipe->getTitle();
        $dto->description          = $recipe->getDescription();
        $dto->calories             = $recipe->getCalories();
        $dto->weight             = $recipe->getWeight();

        if ($recipes) {
            $recipesResponseDto        = new RecipesResponseDto();
            $recipesResponseDto->id    = $recipes->getId();
            $recipesResponseDto->phone = $recipes->getTitle();
            $recipesResponseDto->name  = $recipes->getDescription();

            $dto->recipes = $recipesResponseDto;
        }

        return $dto;
    }
    

    /**
     * @Route(path="/{id<%app.mongo_id_regexp%>}", methods={"DELETE"})
     * @IsGranted(Permission::RECIPES_DELETE)
     * @ParamConverter("recipes")
     *
     * @Rest\View()
     *
     * @param Recipes|null      $recipes
     * @param RecipesRepository $recipesRepository
     *
     * @return RecipesResponseDto|ValidationFailedResponse
     */
    public function delete(
        RecipesRepository $recipesRepository,
        Recipes $recipes = null
    ) {
        if (!$recipes) {
            throw $this->createNotFoundException('Recipes not found');
        }

        $recipesRepository->remove($recipes);
    }
}

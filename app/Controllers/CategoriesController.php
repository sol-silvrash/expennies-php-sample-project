<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\BaseEntityManagerServiceInterface;
use App\Entity\User;
use App\Enums\NavigationPage;
use App\Services\RequestService;
use Slim\Views\Twig;
use Ramsey\Uuid\Uuid;
use App\Entity\Category;
use App\Services\CategoryService;
use App\ResponseFormatter;
use App\Contracts\RequestValidatorFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\RequestValidator\CreateCategoryRequestValidator;
use App\RequestValidator\UpdateCategoryRequestValidator;

class CategoriesController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly RequestValidatorFactoryInterface $requestValidatorFactory,
        private readonly CategoryService $categoryService,
        private readonly ResponseFormatter $responseFormatter,
        private readonly RequestService $requestService,
        private readonly BaseEntityManagerServiceInterface $entityManagerService,
    ) {
    }

    public function index(Response $response): Response
    {
        return $this->twig->render(
            $response,
            'home/categories/index.twig',
            [
                'page' => NavigationPage::CATEGORIES->value
            ]
        );
    }

    public function load(Request $request, Response $response): Response
    {
        $params = $this->requestService->getDataTableQueryParameters($request);
        $categories = $this->categoryService->getPaginatedCategories($params);

        $transformer = fn(Category $category) => [
            'id' => $category->getId(),
            'name' => $category->getName(),
            'createdAt' => $category->getCreatedAt()->format('m/d/Y g:i A'),
            'updatedAt' => $category->getUpdatedAt()->format('m/d/Y g:i A'),
        ];

        $totalCategories = count($categories);
        return $this->responseFormatter->asDataTable(
            $response,
            array_map($transformer, (array) $categories->getIterator()),
            $params->draw,
            $totalCategories,
        );
    }

    public function get(Response $response, Category $category): Response
    {
        $data = [
            'id' => $category->getId(),
            'name' => $category->getName()
        ];

        return $this->responseFormatter->asJson($response, $data);
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $this->requestValidatorFactory->make(CreateCategoryRequestValidator::class)->validate($request->getParsedBody());
        $category = $this->categoryService->create(
            $data['name'],
            $request->getAttribute('user')
        );

        $this->entityManagerService->sync($category);

        return $response;
    }

    public function delete(Response $response, Category $category): Response
    {
        $this->entityManagerService->delete($category, true);
        return $response;
    }

    public function update(Request $request, Response $response, Category $category): Response
    {
        $data = $this->requestValidatorFactory->make(UpdateCategoryRequestValidator::class)->validate(
            $request->getParsedBody()
        );

        $this->entityManagerService->sync(
            $this->categoryService->update($category, $data['name'])
        );

        return $response;
    }
}
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Attribute\Route;
use DatetimeImmutable;

#[Route('todo', name: 'app_todo_')]
final class ToDoController extends AbstractController
{
    private Request $request;

    public function __construct(
        RequestStack $requestStack,
    ) {
        $this->request = $requestStack->getCurrentRequest();
    }

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('todo/index.html.twig');
    }

    #[Route('/list', name: 'list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        // $this->mockList()
        return $this->json($this->request->getSession()->get('todo.list', []));
    }

    #[Route('/create', name: 'create', methods: ['POST'])]
    public function create(): JsonResponse
    {
        $id = $this->request->getSession()->get('todo.id', 0);
        $list = $this->request->getSession()->get('todo.list', []);
        $item = $this->request->getPayload()->all();
        $item['id'] = ++$id;
        $item['createdAt'] = (new DatetimeImmutable())->format('Y-m-d H:i:s');
        $list[] = $item;
        $this->request->getSession()->set('todo.list', $list);
        $this->request->getSession()->set('todo.id', $id);
        return $this->json($item);
    }

    private function mockList(): void
    {
        $this->request->getSession()->set('todo.id', 2);
        $this->request->getSession()->set('todo.list', [
            [
                "id" => 1,
                "title" => "Kupić mleko",
                "completed" => false,
                "createdAt" => "2025-08-21 10:30:00",
                "dueDate" => "2025-08-22 18:00:00",
                "priority" => "high",
                "category" => "zakupy",
                "notes" => "Kupić jajka"
            ],
            [
                "id" => 2,
                "title" => "Kupić mleko",
                "completed" => false,
                "createdAt" => "2025-08-21 10:30:00",
                "dueDate" => "2025-08-22 18:00:00",
                "priority" => "high",
                "category" => "zakupy",
                "notes" => "Kupić też jajka"
            ]
        ]);
    }
}

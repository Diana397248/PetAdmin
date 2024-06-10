<?php

namespace App\Http\Controllers;

use App\Http\Requests\Base\PaginationRequest;
use App\Http\Requests\Client\ClientBulkDeleteRequest;
use App\Http\Requests\Client\ClientSearchRequest;
use App\Http\Requests\Client\ClientStoreRequest;
use App\Http\Requests\Client\ClientUpdateRequest;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function index(): \Inertia\Response
    {
        return Inertia::render('Clients/Index');
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('Clients/Create');
    }

    public function show($slug): \Inertia\Response
    {
        $client = $this->clientService->findClientBySlug($slug);
        return Inertia::render('Clients/Show', ['client' => $client]);
    }


    public function edit($slug): \Inertia\Response
    {
        $client = $this->clientService->findClientBySlug($slug);
        return Inertia::render('Clients/Edit', ['client' => $client]);
    }

    public function store(ClientStoreRequest $request): JsonResponse
    {
        $user = $this->clientService->storeClient($request->validated());
        return response()->json(['message' => 'Клиент успешно добавлен!'], 201);
    }

    public function update(ClientUpdateRequest $request, $id): JsonResponse
    {
        $client = $this->clientService->updateClient($request->validated(), $id);
        return response()->json(['message' => 'Клиент обновлен успешно'], 201);
    }

    public function destroy($id): JsonResponse
    {
        $this->clientService->destroyClient($id);
        return response()->json(['message' => 'Клиент успешно удален'], 201);
    }

    public function bulkDelete(ClientBulkDeleteRequest $request): JsonResponse
    {
        $this->clientService->bulkDeleteClients($request->validated()['selectedIds']);
        return response()->json(['message' => 'Выбранные клиенты успешно удалены'], 201);
    }

    public function fetchAllClients(PaginationRequest $request): JsonResponse
    {
        $clients = $this->clientService->fetchAllClients($request->query('page', 1));
        return response()->json($clients, 201);
    }

    public function getProfile(): JsonResponse
    {
        $userId = Auth::user()->id;
        $client = Client::where('user_id', $userId)->firstOrFail();
        return response()->json($client, 200);
    }

    public function search(ClientSearchRequest $request): JsonResponse
    {
        $clients = $this->clientService->searchClients($request->validated()['keywords']);
        return response()->json($clients, 201);
    }

}

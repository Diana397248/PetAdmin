<?php

namespace App\Http\Controllers;

use App\Http\Requests\Base\PaginationRequest;
use App\Models\Client;
use App\Models\User;
use App\Models\Vet;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Users/Index');
    }

    public function fetchAllUsers(PaginationRequest $request): JsonResponse
    {
        $users = $this->userService->fetchAllUsers($request->query('page', 1));
        return response()->json($users, 201);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($email)
    {
        $user = User::where('email', $email)->first();

// TODO
        if ($user->photo) {
            $user->photo = url('/') . '/' . $user->photo;
        }

        // Return the user as a JSON response
//        TODO Pets/Show
        return Inertia::render('Pets/Show', [
            'user' => $user
        ]);
    }

    public function changeRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $oldRole = $user->role;
        if ($oldRole === 'doctor') {
            $vet = Vet::where('user_id', $userId)->first();
            if ($vet) {
                $vet->delete();
            }
        } else if ($oldRole === 'client') {
            $client = Client::where('user_id', $userId)->first();
            if ($client) {
                $client->delete();
            }
        } else if ($oldRole === 'cashier') {
            // TODO
        }

        $newRole = $request->input('role');
        $user->role = $newRole;
        $user->save();

        if ($newRole === 'doctor') {
            $newVet = new Vet();
            $newVet->user_id = $user->id;
            $newVet->save();
        } else if ($newRole === 'client') {
// TODO
        } else if ($newRole === 'cashier') {
            // TODO
        }

        return response()->json([
            'message' => 'Роль успешно изменена!'],
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

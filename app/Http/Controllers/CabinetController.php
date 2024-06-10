<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileUpdateRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Cabinet/Index');
    }

    /**
     * Display a listing of the resource.
     */
    public function calendars(): \Inertia\Response
    {
        return Inertia::render('Cabinet/Appointment/Calendars');
    }

    /**
     * Display a listing of the resource.
     */
    public function addAppointment(): \Inertia\Response
    {
        return Inertia::render('Cabinet/Appointment/AddAppointment');
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
    public function show(string $id)
    {
        //
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

    public function updateUserProfile(UserProfileUpdateRequest $request)
    {
        $formData = $request->validated();
        $currentUser = Auth::user();
        $userProfile = Client::where('user_id', $currentUser->id)->firstOrFail();

        $updatedUserName = "";
        if ($formData['second_name']) {
            $updatedUserName = $updatedUserName . $formData['second_name'];
        }
        if ($formData['name']) {
            $updatedUserName = $updatedUserName . " " . strtoupper(mb_substr($formData['name'], 0, 1)) . ".";
        }
        if ($formData['patronymic']) {
            $updatedUserName = $updatedUserName . " " . strtoupper(mb_substr($formData['patronymic'], 0, 1)) . ".";
        }
        $currentUser->name = $updatedUserName;
        $currentUser->save();

        $userProfile->name = $formData['name'];
        $userProfile->second_name = $formData['second_name'];
        $userProfile->patronymic = $formData['patronymic'];
        $userProfile->phone_number = $formData['phone_number'];
        $userProfile->notes = $formData['notes'];
        $userProfile->save();
        return response()->json(['message' => 'Данные успешно обновлены'], 201);
    }
}

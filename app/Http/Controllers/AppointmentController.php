<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\AppointmentService;
use App\Http\Requests\Appointment\AppointmentRequest;

class AppointmentController extends Controller
{
    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function index()
    {
        return Inertia::render('Appointments/Index');
    }

    public function store(AppointmentRequest $request)
    {
        $validatedData = $request->validated();
        $this->appointmentService->storeAppointment($validatedData);

        return response()->json([
            'message' => 'Событие успешно создано',
        ], 201);
    }

    public function fetchAllAppointments(Request $request) {
        $appointments = $this->appointmentService->fetchAllAppointments(false);
        if ($request->has('all')) {
            $appointments = $this->appointmentService->fetchAllAppointments(true);
        }
        return response()->json($appointments, 201);
    }

    public function fetchAllClients()
    {
        $users = $this->appointmentService->fetchAllClients();

        return response()->json($users);
    }

    public function fetchAllVets()
    {
        $vets = $this->appointmentService->fetchAllVets();

        return response()->json($vets);
    }

    public function searchClients(Request $request)
    {
        $query = $request->input('query');
        $limit = $request->input('limit', 10);
        $users = $this->appointmentService->searchClients($query, $limit);

        return response()->json($users);
    }

    public function edit($id)
    {
        $appointment = $this->appointmentService->fetchAppointmentById($id);

        return response()->json($appointment, 200);
    }

    public function update(AppointmentRequest $request, $id)
    {
        $validatedData = $request->validated();
        $this->appointmentService->updateAppointment($id, $validatedData);

        return response()->json([
            'message' => 'Встреча успешно обновлена',
        ], 200);
    }

    public function destroy($id)
    {
        $this->appointmentService->deleteAppointment($id);

        return response()->json([
            'message' => 'Встреча успешно удалена',
        ], 200);
    }
}

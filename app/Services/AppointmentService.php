<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Vet;
use Illuminate\Support\Facades\Auth;

class AppointmentService
{
    public function storeAppointment($data)
    {
        if (Auth::user()->role === 'client') {
            $client = Client::where('user_id', Auth::user()->id)->firstOrFail();
            if ($client) {
                $data['client_id'] = $client->id;
            }
        }

        return Appointment::create($data);
    }

    public function fetchAllAppointments(bool $all)
    {
        $appointmentQuery = Appointment::with('client', 'vet', 'vet.user');

        if (!$all && Auth::user()->role === 'client') {
            $client = Client::where('user_id', Auth::user()->id)->first();
            if ($client) {
                $appointmentQuery = $appointmentQuery->where('client_id', $client->id);
            }
        } else if (!$all && Auth::user()->role === 'doctor') {
            $vet = Vet::where('user_id', Auth::user()->id)->first();
            if ($vet) {
                $appointmentQuery = $appointmentQuery->where('vet_id', $vet->id);
            }
        }

        return $appointmentQuery->orderBy('start_time', 'ASC')->get();
    }

    public function fetchAppointmentById($id)
    {
        return Appointment::with('client')->with('vet')->findOrFail($id);
    }

    public function updateAppointment($id, $data)
    {
        $appointment = $this->fetchAppointmentById($id);
        $appointment->update($data);

        return $appointment;
    }

    public function deleteAppointment($id)
    {
        $appointment = $this->fetchAppointmentById($id);
        $appointment->delete();

        return $appointment;
    }

    public function fetchAllClients($limit = 10)
    {
        return Client::orderBy('id')->limit($limit)->get();
    }

    public function fetchAllVets($limit = 10)
    {
        return Vet::orderBy('id')->limit($limit)->with('user')->get();
    }

    public function searchClients($query, $limit = 10)
    {
        return Client::where('name', 'like', '%' . $query . '%')->limit($limit)->get();
    }
}

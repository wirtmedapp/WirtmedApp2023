<?php

namespace App\Http\Controllers;

use App\Interfaces\HorarioServiceInterface;
use App\Mail\notificaciones;
use App\Models\Appointment;
use App\Models\CancelledAppointment;
use App\Models\Specialty;
use App\Models\Entity;
use App\Models\Service;
use App\Models\User;
use App\Models\Sedes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{

    public function index(){

        $role = auth()->user()->role;

        if($role == 'admin'){
            //Admin
            $confirmedAppointments = Appointment::all()
            ->where('status', 'Confirmada');
            $pendingAppointments = Appointment::all()
            ->where('status', 'Reservada');
            $oldAppointments = Appointment::all()
            ->whereIn('status', ['Atendida','Cancelada']);
        }elseif($role == 'doctor'){
            //Doctor
            $confirmedAppointments = Appointment::all()
            ->where('status', 'Confirmada')
            ->where('doctor_id', auth()->id());
            $pendingAppointments = Appointment::all()
            ->where('status', 'Reservada')
            ->where('doctor_id', auth()->id());
            $oldAppointments = Appointment::all()
            ->whereIn('status', ['Atendida','Cancelada'])
            ->where('doctor_id', auth()->id());
        }elseif($role == 'paciente'){
            //Pacientes
            $confirmedAppointments = Appointment::all()
            ->where('status', 'Confirmada')
            ->where('patient_id', auth()->id());
            $pendingAppointments = Appointment::all()
            ->where('status', 'Reservada')
            ->where('patient_id', auth()->id());
            $oldAppointments = Appointment::all()
            ->whereIn('status', ['Atendida','Cancelada'])
            ->where('patient_id', auth()->id());
        }elseif($role == 'asesor'){
            //Asesor
            $confirmedAppointments = Appointment::all()
            ->where('status', 'Confirmada');
            $pendingAppointments = Appointment::all()
            ->where('status', 'Reservada');
            $oldAppointments = Appointment::all()
            ->whereIn('status', ['Atendida','Cancelada']);
        }

        
        return view('appointments.index', 
        compact('confirmedAppointments', 'pendingAppointments', 'oldAppointments', 'role') );
    }

    public function create(HorarioServiceInterface $horarioServiceInterface) {
        $specialties = Specialty::all();
        $entity = Entity::all();
        $services = Service::all();
        // $sedes = Sedes::all();

        $specialtyId = old('specialty_id');
        if ($specialtyId) {
            $specialty = Specialty::find($specialtyId);
            // $specialty_ids = $doctor->specialties()->pluck('specialties.id');
            $doctors = $specialty->users;
        } else {
            $doctors = collect();
        }

        $entityId = old('entity_id');
        if ($entityId) {
            $entity = Entity::find($entityId);
            $doctors = $entity->users;
        } else {
            $doctors = collect();
        }

        $serviceId = old('service_id');
        if ($serviceId) {
            $service = Service::find($serviceId);
        }

        $date = old('scheduled_date');
        $doctorId = old('doctor_id');
        if ($date && $doctorId) {
            $intervals = $horarioServiceInterface->getAvailableIntervals($date, $doctorId);
        }else {
            $intervals = null;
        }

        return view('appointments.create', compact('specialties', 'services', 'doctors', 'entity', 'intervals'));
    }

    public function store(Request $request, HorarioServiceInterface $horarioServiceInterface) {

        $rules = [
            'scheduled_time' => 'required',
            'type' => 'required',
            'description' => 'required',
            'doctor_id' => 'exists:users,id',
            'specialty_id' => 'exists:specialties,id',
            'service_id' => 'exists:services,id',
            'entity_id' => 'exists:entities,id'
        ];

        $messages = [
            'scheduled_time.required' => 'Debe seleccionar una hora para su cita.',
            'type.required' => 'Debe seleccionar el tipo de consulta.',
            'description.required' => 'Debe poner sus síntomas.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator) use ($request, $horarioServiceInterface) {

            $date = $request->input('scheduled_date');
            $doctorId = $request->input('doctor_id');
            $scheduled_time = $request->input('scheduled_time');
            if ($date && $doctorId && $scheduled_time) {
                $start = new Carbon($scheduled_time);
            }else {
                return;
            }

            if (!$horarioServiceInterface->isAvailableInterval($date, $doctorId, $start)) {
                $validator->errors()->add(
                    'available_time', 'La hora seleccionada ya se encuentra reservada por otro paciente.'
                );
            }
        });

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $request->only([
            'scheduled_date',
            'scheduled_time',
            'type',
            'description',
            'doctor_id',
            'specialty_id'
        ]);
        $data['patient_id'] = auth()->id();
        
        $carbonTime = Carbon::createFromFormat('g:i A', $data['scheduled_time']);
        $data['scheduled_time'] = $carbonTime->format('H:i:s');

        Appointment::create($data);

        $notification = 'La cita se ha realizado correctamente.';
        return redirect('/miscitas')->with(compact('notification'));
        
    }

    public function cancel(Appointment $appointment, Request $request) {

        if($request->has('justification')){
            $cancellation = new CancelledAppointment();
            $cancellation->justification = $request->input('justification');
            $cancellation->cancelled_by_id = auth()->id();

            $appointment->cancellation()->save($cancellation);
        }

        $appointment->status = 'Cancelada';
        $appointment->save();
        $notification = 'La cita se ha cancelado correctamente.';

        return redirect('/miscitas')->with(compact('notification'));
    }

    public function confirm(Appointment $appointment) {

        $appointment->status = 'Confirmada';
        $appointment->save();
        $notification = 'La cita se ha confirmado correctamente.';

        return redirect('/miscitas')->with(compact('notification'));
    }

    public function formCancel(Appointment $appointment) {
        if($appointment->status == 'Confirmada' || 'Reservada'){
            $role = auth()->user()->role;
            return view('appointments.cancel', compact('appointment', 'role'));
        }
        
    }

    public function show(Appointment $appointment){
        $role = auth()->user()->role;
        return view('appointments.show', compact('appointment', 'role'));
    }

    // public function sendAppointment (Appointment $appointment) {
    //     Mail::to('no-responder@wirtmed.com')->send(new notificaciones());
    //     return redirect('/');
    // }

    public function enviarConfirmacionCita($notificationes)
    {
        // Obtener los detalles de la cita
        $notificationes = Appointment::find($notificationes);
        $patient = $notificationes->paciente;
        $specialty_id = $notificationes->especialista;
        $fecha = $notificationes->fecha;
        $hora = $notificationes->hora;
        $lugar = $notificationes->lugar;

        // Preparar el correo
        $data = [
            'paciente' => $patient,
            'especialista' => $specialty_id,
            'fecha' => $fecha,
            'hora' => $hora,
            'lugar' => $lugar,
        ];
        Mail::send('emails.confirmacion-cita', $data, function ($message) use ($patient) {
            $message->from('no-responder@wirtmed.com', 'Wirtmed');
            $message->to($patient->email, $patient->nombre)->subject('Confirmación de cita médica');
        });
    }

    public function autocompleteform()
    {
        
        $valor = $_POST['valor'];
        switch($valor){
            case 1:
                $id = $_POST['id'];
                $entity = Entity::findOrFail($id);
                $specialty_ids = $entity->specialties()->pluck('specialties.id','specialties.name');
                // dd($specialty_ids->all());
                return response($specialty_ids);
            break;    
            case 2:
                $id = $_POST['id'];
                $specialty = Specialty::findOrFail($id);
                $doctors_id = $specialty->users()->pluck('users.id','users.name');
                return response($doctors_id);
            break;
            case 3:
                $id = $_POST['id'];
                $doctor = User::findOrFail($id);
                $sedes_id = $doctor->sedes()->pluck('sedes.id', 'sedes.name');
                return response($sedes_id);
            break;
            case 4:
                $id_sede = $_POST['id'];
                $id_specialty = $_POST['id_specialty'];
                $services = DB::select('SELECT services.id,services.name FROM sedes inner join sedes_service on sedes.id=sedes_service.sedes_id inner join services on sedes_service.service_id = services.id inner join service_specialty on services.id = service_specialty.service_id where sedes.id=? and service_specialty.specialty_id=?',[$id_sede,$id_specialty]);
                return response($services);
            break;
        }
    }
}
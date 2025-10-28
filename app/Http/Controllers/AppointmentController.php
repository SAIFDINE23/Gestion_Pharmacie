<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use Illuminate\Http\Request;

class appointmentController extends Controller
{
    public function index(){
        $appointments=Appointment::paginate(5);
        return view('appointments.info',compact('appointments'));
    }

    public function store(Request $request){
        $appointment = new Appointment([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Sauvegarder le rendez-vous dans la base de données
        $appointment->save();

        // Rediriger avec un message de succès
        return redirect()->route('client.home')->with('success', 'Appointment added successfully.');
    }

    public function delete($id){
        $appointment = Appointment::findOrFail($id); // Trouver l'objet Appointment avec l'ID donné
        $appointment->delete(); // Appeler la méthode delete() sur l'instance de l'objet trouvé
        return redirect('/appointments')->with('success', 'Appointment supprimé avec succès');
    }
    public function show($id){
        $appointment = Appointment::findOrFail($id); // Récupérer le rendez-vous spécifique en fonction de son ID
        return view('appointments.details', compact('appointment')); // Passer le rendez-vous à la vue
    }
    
    
}

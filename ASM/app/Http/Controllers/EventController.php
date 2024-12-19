<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use DateTime;

class EventController extends Controller
{
    public function getEvents()
    {
        try {
            $events = Event::all();
            return response()->json($events);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des événements'], 500);
        }
    }

    public function addEventToCalendar(Request $request)
    {
        try {
            $event = new Event();
            $event->title = $request->input('title');
            $event->start = new DateTime($request->input('start'));
            $event->save();

            return response()->json($event, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de l\'ajout de l\'événement'], 500);
        }
    }

    public function updateEvent(Request $request, $id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->title = $request->input('title');
            $event->start = new DateTime($request->input('start'));
            $event->save();

            return response()->json($event);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la mise à jour de l\'événement'], 500);
        }
    }

    public function deleteEvent($id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();

            return response()->json(['success' => 'Événement supprimé avec succès']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression de l\'événement'], 500);
        }
    }
}

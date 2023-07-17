<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
        $this->authorizeResource(Event::class, 'event', ['except' => ['index', 'show']]);
    }

    public function index(): View
    {
        $search = request('search_event');

        if ($search) {
            $public_events_list = Event::where([
                ['private', '=', '0'],
                ['title', 'like', '%' . $search . '%']
            ])->orWhere([
                ['location', 'like', '%' . $search . '%'],
            ])->get();
        } else {
            $public_events_list = Event::where('private', '=', '0')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('events.index', [
            'public_events' => $public_events_list,
            'search' => $search
        ]);
    }

    public function create(): View
    {
        return view('events.create');
    }

    public function store(StoreEventRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $event = new Event();
        $event->user_id = auth()->user()->id;
        $event->title = ucfirst($validated['event_title']);
        $event->start_date = $validated['event_start_date'];
        $event->end_date = $validated['event_end_date'];
        $event->location = $validated['event_location'];
        $event->description = ucfirst($validated['event_description']);
        $event->private = $validated['event_private'];
        $event->items = $validated['items'];

        //upload image
        $image_name = sha1($validated['event_image']->getClientOriginalName()) . time() . '.' . $validated['event_image']->getClientOriginalExtension();
        $validated['event_image']->move(public_path('events/images'), $image_name);
        $event->image = $image_name;

        $event->save();

        return redirect()
            ->route('event.index')
            ->with('success', 'Evento criado com sucesso!');
    }

    public function show(Event $event): View
    {
        return view('events.show', [
            'event' => $event
        ]);
    }

    public function edit(Event $event): View
    {
        return view('events.edit', [
            'event' => $event
        ]);
    }

    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $validated = $request->validated();
        
        $event->title = ucfirst($validated['event_title']);
        $event->description = ucfirst($validated['event_description']);
        $event->location = $validated['event_location'];
        $event->private = $validated['event_private'];
        $event->start_date = $validated['event_start_date'];
        $event->end_date = $validated['event_end_date'];
        $event->items = $validated['items'];

        if ($request->hasFile('event_image')) {
            $image_name = sha1($validated['event_image']->getClientOriginalName()) . time() . '.' . $validated['event_image']->getClientOriginalExtension();
            $validated['event_image']->move(public_path('events/images'), $image_name);
            $event->image = $image_name;
        }

        $event->save();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();
        return redirect()
            ->route('dashboard')
            ->with('success', 'Evento removido com sucesso');
    }

    public function attend($id)
    {

        auth()->user()->participants()->attach($id);
        $event = Event::findOrFail($id);

        return redirect()->route('event.index')
            ->with('success', 'Vocë está participando do evento ' . $event->title . '!');
    }

    public function unattend($id)
    {
        auth()->user()->participants()->detach($id);
        $event = Event::findOrFail($id);

        return redirect()->route('event.index')
            ->with('success', 'Vocë saiu do evento ' . $event->title);
    }
}

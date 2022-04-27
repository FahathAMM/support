<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketRepo;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $model;
    protected $repo;
    protected $redirect;

    public function __construct(Ticket $model, TicketRepo $Repo)
    {
        $this->model = $model;
        $this->repo = $Repo;
        $this->redirect = route('tickets.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.clients.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.clients.customer.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate($this->model->storeRules());

            $extraAttributes = [
                'reference' => sha1(time()),
            ];

            $item =  $this->repo->createWithAlertMessage($request->except('reference'), ['status', 'Stored Was Successful'], $extraAttributes);


            if (!is_null($item)) {

                $this->repo->sentMail($item);

                return  redirect($this->redirect . '/' . $item->id);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $this->repo->isRead($ticket);
        try {
            return view('pages.clients.customer.view', [
                'ticket' => $ticket
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function myTicket(Request $request)
    {
        $ticket = $this->model->whereReference($request->reference)->firstOrFail();
        try {
            return view('pages.clients.customer.view', [
                'ticket' => $ticket
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

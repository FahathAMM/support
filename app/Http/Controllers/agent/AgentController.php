<?php

namespace App\Http\Controllers\agent;

use App\Models\User;
use App\helpers\Helpers;
use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Models\Message\Message;
use App\Models\Ticket\TicketRepo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{

    protected $model;
    protected $repo;
    protected $redirect;

    public function __construct(Ticket $model, TicketRepo $Repo)
    {
        $this->model = $model;
        $this->repo = $Repo;
        $this->redirect = route('agents.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $items = $this->repo->search($request->q, Helpers::perPage(Ticket::PER_PAGE));

            return view('pages.agents.tickets.index', [
                'tickets' => $items,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function reply(Request $request)
    {
        // return $request;
        try {
            $this->repo->storeMessage($request);

            $this->repo->sentMail($request);

            return redirect($this->redirect)->with('status', 'successfully sended');
        } catch (\Throwable $th) {
            throw $th;
        }


        return $request;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

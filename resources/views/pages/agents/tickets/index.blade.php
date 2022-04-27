@extends('layouts.agent')


@section('content')
    @include('includes.navbar')
    <div class="col-12 col-md-12">
        <div class="card text-left">
            <div class="card-header bg-primary">
                <h4 class="card-title">Title</h4>
            </div>
            <div class="card-body">
                <x-alert />
                <div>
                    <form action="{{ route('agents.index') }}" method="GET">
                        <div class="form-group d-flex  w-25">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search"
                                class="form-control mx-1 form-control-sm" style="height: 12px;">
                            <button type="submit" class="btn btn-primary" style="height: 31px;">Save</button>
                            <a href="{{ route('agents.index') }}" type="submit" class="btn btn-danger ms-1"
                                style="height: 31px;">Clear</a>
                        </div>
                    </form>
                </div>

                <table class="table table-responsive-md">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>phone</th>
                            <th>Reference</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Reply By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($tickets as $key => $ticket)
                            @php
                                $message = App\Models\message\Message::with('user')
                                    ->where('ticket_id', $ticket->id)
                                    ->first();
                                // echo isset($message->user->name) ? $message->user->name : '';
                            @endphp

                            <tr class="{{ $ticket->is_read == 0 ? 'bg-light fw-bolder' : '' }}">
                                <td scope="row">{{ $key + $tickets->firstItem() }}</td>
                                <td scope="row">{{ $ticket->name }}</td>
                                <td scope="row">{{ $ticket->email }}</td>
                                <td scope="row">{{ $ticket->phone }}</td>
                                <td scope="row">{{ $ticket->reference }}</td>
                                <td scope="row">{{ App\helpers\Helpers::isRead($ticket->is_read) }}</td>
                                <td scope="row">{{ Str::limit($ticket->description, 10, '...') }}</td>
                                <td scope="row">{{ isset($message->user->name) ? $message->user->name : '' }}</td>

                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('tickets.show', ['ticket' => $ticket->id]) }}"
                                            class="btn btn-primary">View</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
@endsection

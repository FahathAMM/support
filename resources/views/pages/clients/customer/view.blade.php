@extends('layouts.client')
@section('content')
    @include('includes.navbar')
    <div class=" col-md-6 offset-md-3">
        <section class="">
            <div>
                <div class="card text-left">
                    <div class="card-header">Your Ticket</div>
                    <div class="card-body">
                        <x-alert />
                        @if ($ticket->count() > 0)
                            <div class="row">

                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Referance</th>
                                            <td scope="row">{{ $ticket->reference }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Name</th>
                                            <td scope="row">{{ $ticket->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td scope="row">{{ $ticket->email }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Name</th>
                                            <td scope="row">{{ $ticket->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Description</th>
                                            <td scope="row">{{ $ticket->description }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <small>Please Note Your Reference Number for Check your Ticket </small>
                            </div>
                        @endif
                        @auth
                            <section class="mt-4">
                                <form action="{{ route('reply') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" id="">
                                    <input type="hidden" name="email" value="{{ $ticket->email }}" id="">
                                    <textarea name="reply" class="form-control" id="" cols="30" rows="10" required></textarea>
                                    <button type="submit" class="btn btn-success mt-2">Rebly</button>
                                </form>

                            </section>
                        @endauth
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

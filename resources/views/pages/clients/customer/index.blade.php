@extends('layouts.client')


@section('content')
    @include('includes.navbar')
    <section class="col-md-6 mt-5 offset-3">
        <form action="{{ route('my.ticket') }}" method="GET">

            <div>
                <h1>Support Ticket System </h1>
            </div>
            <div>
                <p>Enter your Referance Number</p>
                <input type="text" class="form-control" name="reference" id="" required>
            </div>
            <div>
                <button type="submit" class="btn mt-3 btn-primary">Submit</button>
            </div>
        </form>
    </section>
@endsection

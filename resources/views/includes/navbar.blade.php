<nav class="nav">
    <a class="nav-link" href="{{ route('tickets.index') }}">Check Status</a>
    <a class="nav-link" href="{{ route('tickets.create') }}">Create Ticket</a>
    @auth
        <a class="nav-link" href="{{ route('agents.index') }}">Ticket List</a>
    @endauth
</nav>

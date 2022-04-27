@if (session('status'))
    <div class="alert py-2 alert-success" role="alert">
        <h4 class="alert-heading">Message</h4>
        <p style="padding: 0;margin: 0;">{{ session('status') }}</p>
        <small>Please Check your Email</small>
    </div>
@endif

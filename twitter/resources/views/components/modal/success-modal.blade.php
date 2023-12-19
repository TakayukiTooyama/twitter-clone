@if (session('success'))
    <div id="alert-success" class="alert alert-success position-fixed"
        style="top: 88px; left: 50%; transform: translateX(-50%); width: auto; max-width: 90%;">
        {{ session('success') }}
    </div>
@endif

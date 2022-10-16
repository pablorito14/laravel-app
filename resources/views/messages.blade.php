
  @if (session('message_error'))
  <div class="alert alert-danger py-2">
      {{ session('message_error') }} 
  </div>
  @endif

  @if (session('message_success'))
  <div class="alert alert-success py-2">
      {{ session('message_success') }} 
  </div>
  @endif


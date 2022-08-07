@if(session("success") != null)
    @if(is_array(session("success")))
        <div class="alert alert-success" style="margin:15px" role="alert">
            @foreach (session("success") as $succ)
                • {{$succ}} <br>
            @endforeach
        </div>
    @else
        <div class="alert alert-success" style="margin:15px" role="alert">
            • {{session("success")}} <br>
        </div>
    @endif
@endif

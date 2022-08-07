@if( $page !== 'mails')
    <a class="waves-effect btn btn-xs btn-primary edit-btn" data-value="$data->id"
       href="{{route("{$page}.edit", $data->id)}}">Update</a>

@else
    @if($data->scheduled == "Yes" && !$data->is_sent)
        <a class="waves-effect btn btn-xs btn-primary edit-btn" data-value="$data->id"
           href="{{route("{$page}.edit", $data->id)}}">Update</a>
    @endif
@endif

@if( !($page == 'mails' && $data->is_sent))
    <form action="{{route("{$page}.destroy", $data->id)}}" method="POST" onsubmit="return confirm('Are you sure?')"
          style="display: inline-block;">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
    </form>
@else
    <span>No Action</span>
@endif

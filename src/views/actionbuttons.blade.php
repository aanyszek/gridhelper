
@if( $view )
<a href="{{ url($url . '/' . $val) }}" class="btn btn-success btn-xs" title="View">
    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"/>
</a>
@endif
@if( $edit )
<a href="{{ url($url . '/' . $val . '/edit') }}" class="btn btn-primary btn-xs" title="Edit">
    <span class="glyphicon glyphicon-pencil" aria-hidden="true"/>
</a>
@endif
@if( $edit2 )
<a href="{{ url($url . '/' . $val . '/admin') }}" class="btn btn-success btn-xs" title="Admin">
    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"/>
</a>
@endif
@if( $delete )
{!! Form::open([
'method'=>'DELETE',
'url' => [$url, $val],
'style' => 'display:inline'
]) !!}
{!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete" />', array(
'type' => 'submit',
'class' => 'btn btn-danger btn-xs',
'title' => 'Delete Order',
'onclick'=>'return confirm("Confirm delete?")'
));!!}
{!! Form::close() !!}
@endif

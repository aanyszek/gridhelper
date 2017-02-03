
@if( $view )
<a href="{{ url($url . '/' . $val) }}" class="btn btn-success btn-xs" title="View Order">
    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"/>
</a>
@endif
@if( $edit )
<a href="{{ url($url . '/' . $val . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Order">
    <span class="glyphicon glyphicon-pencil" aria-hidden="true"/>
</a>
@endif
@if( $edit2 )
<a href="{{ url($url . '/' . $val . '/edit') }}" class="btn btn-success btn-xs" title="Loan">
    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"/>
</a>
@endif
@if( $delete )
{!! Form::open([
'method'=>'DELETE',
'url' => [$url, $val],
'style' => 'display:inline'
]) !!}
{!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Order" />', array(
'type' => 'submit',
'class' => 'btn btn-danger btn-xs',
'title' => 'Delete Order',
'onclick'=>'return confirm("Confirm delete?")'
));!!}
{!! Form::close() !!}
@endif

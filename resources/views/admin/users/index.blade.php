@foreach($users as $user)

	<li>
		{!! $user['fname'] !!}
		{!! $user['lname'] !!}
		from the
		{!! $user['loc'] !!}
	</li>

@endforeach
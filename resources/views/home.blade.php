@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">User Lists</div>
				<div class="panel-body">
					<table class="table table-condensed table-striped">
						<thead>
							<tr>
								<th class="text-right">#</th>
								<th>Name</th>
								<th>Username</th>
								<th>Email</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $key => $user)
							<tr>
								<td class="text-right">{{ $key + 1 }}</td>
								<td>{{ $user->last_name . ', ' . $user->first_name }}</td>
								<td>{{ $user->username }}</td>
								<td>{{ $user->email }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

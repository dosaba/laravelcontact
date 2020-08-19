@extends('layouts.master')
@section('content')
	<h1>Totales</h1>
	<div class="row">
		<table class="table">
			<thead>
				<th>{{__('Asunto')}}</th>
				<th>{{__('Cantidad')}}</th>
				<th>{{__('Porcentaje')}}</th>
			</thead>
			<tbody>
				@foreach( $subjects as $key => $subject )
					<tr>
						<td>{{$subject->name}}</td>
						<td>{{$subject->amount}}</td>
						<td>{{number_format(100*$subject->amount/$total,2)}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>
	<div class="row">
	<a href="{{route('contacto.admin')}}" class="btn btn-primary">{{__('Mensajes')}}</a>
	</div>

@endsection

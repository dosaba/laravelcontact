@extends('layouts.master')
@section('content')
<h1>Listado de Mensajes</h1>
	
	<div class="row col-md-12">
		<div class="col-md-10">
			<a href="{{route('contacto.admin.totals')}}" class="btn btn-primary">ver Totales</a>
		</div>
		<div class="col-md-2 float-right">
			<a target="__blank" href="{{route('contacto.admin.pdf')}}" class="btn btn-secondary">pdf</a>&nbsp;
			<a target="__blank" href="{{route('contacto.admin.xls')}}" class="btn btn-secondary">CSV</a>
		</div>
	</div>

	

<div class="row col-md-12">
	<table class="table table-striped">
		  <thead>
			    <tr>
			      <th scope="col"><a href="{{route('contacto.admin',['page'=>1,'order'=>$orderInvert])}}">@if($orderInvert=='ASC')<i class="fa fa-caret-up" aria-hidden="true"></i>@else<i class="fa fa-caret-down" aria-hidden="true">@endif</i>&nbsp;Fecha</a></th>
			      <th scope="col">{{__('Nombre')}}</th>
			      <th scope="col">{{__('Email')}}</th>
			      <th scope="col">{{__('spamScore')}}</th>
			      <th scope="col">{{__('Asunto')}}</th>
			      <th scope="col">{{__('Mensaje')}}</th>
			    </tr>
		  </thead>
		  <tbody>
			@foreach( $messages as $key => $message )
				<tr>
				<td scope="row">{{date('d/m/Y', strtotime($message->created_at))}}</td>
				<td>{{$message->fromName}}</td>
				<td>{{$message->fromEmail}}</td>
				<td>{{$message->spamScore}}</td>
				<td>{{$message->getSubject->desc}}</td>
				<td>{{$message->body}}</td>
				</tr>
			@endforeach			
			
		 </tbody>
	</table>
</div>
{{ $messages->appends(request()->query())->links() }}


@endsection

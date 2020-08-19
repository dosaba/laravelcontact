@extends('layouts.master')
@section('content')
<h1>Formulario de contacto</h1>
<form method="post" action="{{route('contacto.send')}}" id="contactoform">
	{{csrf_field()}}
	<div class="form-group">
		<label for="name" class="control-label col-sm-2 col-xs-12">{{__('Nombre')}}</label>
		<div class="col-md-10 col-xs-12">
			<input type="text" name="name" value="" class="form-control">
		</div>
		<div class="error col-md-12" id="errorname"></div>
	</div>

	<div class="form-group">
		<label for="email" class="control-label col-sm-2 col-xs-12">{{__('Email')}}</label>
		<div class="col-md-10 col-xs-12">
			<input type="email" name="email" value="" class="form-control">
		</div>
		<div class="error col-md-12" id="erroremail"></div>
	</div>


	<div class="form-group">
		<label for="subject" class="control-label col-sm-2 col-xs-12">{{__('Asunto')}}</label>
		<div class="col-md-10 col-xs-12">
			<select  name="subject" class="form-control">
				@foreach( $subjects as $key => $subject )
				<option value="{{$subject->id}}">{{$subject->desc}}</option>
				@endforeach
			</select>
		</div>
		<div class="error col-md-12" id="errorsubject"></div>
	</div>
	<div class="form-group">
		<label for="message" class="control-label col-sm-2 col-xs-12">{{__('Mensaje')}}</label>
		<div class="col-md-10 col-xs-12">
			<textarea name="messagemail" class="form-control"></textarea>
		</div>
		<div class="error col-md-12" id="errormessagemail"></div>
	</div>

	<div class="row float-right col-md-3">
		<a href="#" class=" btn btn-primary" id="btnsend">{{__('Enviar')}}</a>
	</div>
	<div id="message" class="row float-right col-md-3"></div>

</form>


@endsection
@section('include_js_file')
<script src="{{ asset('js/contacto/contacto.js') }}"></script>
@endsection

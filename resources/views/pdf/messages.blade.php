<html>
<head></head>
<body>
	<table class="table table-striped">
		  <thead>
			    <tr>
			      <th scope="col">{{__('Fecha')}}</th>
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
</body>
</html>

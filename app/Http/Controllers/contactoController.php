<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Validator;
use Mail;
use App\Message;
use App\Subject;
use App\Spam;

class contactoController extends Controller
{
    
	public function index(Request $request){

		return view('contacto.index',array("subjects"=>Subject::get()));
	}

	public function sendContactUser(Request $request){

		$rules= array(
			"name"=>"required",		
			"email"=>array("required","email"),
			"subject"=>"required",
			"messagemail"=>"required",
		);

		$fields = $request->all();
		$validator= Validator::make($fields,$rules);
		if($validator->fails()){
			return Response::json(array(
				"sucess"=>false,
				"errors"=>$validator->getMessageBag()->toArray()
			),200);
		}

		$this->sendAndSave($request);
		return Response::json(array("sucess"=>true));
	}


	private function sendAndSave(Request $request){

		if($request->method()=="POST"){

			$data= $request->all();			
			$subjectObj = Subject::find($request->get('subject'));
			$subject="";
			if($subjectObj->id){
				$subject=$subjectObj->desc;
			}
			$to ="dosaba@gmail.com";
			$data['subject']=$subject;
			$data['date']= date('d/m/Y');

//aca lo ideal sera usar la cola de mensaje para optimizar la respuesta      Mail::queue
			Mail::send('email.contact',$data, function($msj) use($subject,$to,$data){
			    $msj->from($data['email'],$data['name']);
			    $msj->subject($subject);
			    $msj->replyTo($data['email'], '');
			    $msj->to($to);
			});


			$message=Message::create(array(
				"body"=> $data['messagemail'],
				"fromName"=>$data['name'],
				"fromEmail"=>$data['email'],
				"toEmail"=>$to,
				"subjectId"=>$subjectObj->id,
				"spamScore"=>Spam::getSpamScore($request->messagemail)
			
			));
		}




	}


	public function contactAdmin(Request $request){



	return view('contacto_admin.index',array("subjects"=>Message::get()));
	}


}

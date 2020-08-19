<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Subject;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Response;
class contactAdminController extends Controller
{
    //
	protected function getMessages(Request $request,&$order,&$orderInvert,&$list,$paginar=true){

		if(!in_array($order,array("ASC","DESC"))){
			$order="DESC";
		}
		
		if($order=="ASC"){
			$orderInvert="DESC";
		}

		$list=Message::orderBy('created_at',$order);
		if($paginar){
			$list=$list->simplePaginate(3)->appends(request()->query());	
		} else {
			$list=$list->get();
		}
	
	}

	public function index(Request $request){
	
		$order=$request->get('order',"DESC");
		$orderInvert="ASC";
		$list=array();
		$this->getMessages($request,$order,$orderInvert,$list,true);

		return view('admin.contacto.index',array("messages"=>$list,"orderInvert"=>$orderInvert));
	}


	public function pdf(Request $request)
	{        
		

		$order=$request->get('order',"DESC");
		$orderInvert="ASC";
		$list=array();
		$this->getMessages($request,$order,$orderInvert,$list,false);
 

		$pdf = PDF::loadView('pdf.messages', array('messages'=>$list));

		return $pdf->download('list_messages.pdf');
	}


	public function xls(Request $request){

		$headers = array(
			"Content-type" => "text/csv",
			"Content-Disposition" => "attachment; filename=file.csv",
			"Pragma" => "no-cache",
			"Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
			"Expires" => "0"
		);
    
		$columns = array(
				__('Nombre'),
				__('Email'),
				__('spamScore'),
				__('Asunto'),
				__('Mensaje')
		);


		$file = fopen('php://output', 'w');

		$order=$request->get('order',"DESC");
		$orderInvert="ASC";
		$messages=array();
		$this->getMessages($request,$order,$orderInvert,$messages,false);
	
		$callback = function() use ($messages, $columns)
		{
			$file = fopen('php://output', 'w');
			fputcsv($file, $columns);

        		foreach ($messages as $m) {
			    $row=array(
				$message->fromEmail,
				$message->fromName,
				$message->fromEmail,
				$message->spamScore,
				$message->getSubject->desc,
				$message->body
					
				
				);
				fputcsv($file, $row);				
		            
        		}
       

			 fclose($file);
		 };

    	return Response::stream($callback, 200, $headers);

	}

	public function totals(Request $request){

		$subjects=DB::table('subjects','s')
			->select(array("s.id",DB::raw("count(s.id) as amount"),"s.desc as name"))
			->join('messages', 's.id', '=', 'messages.subjectId')
			->groupBy(array('s.id','s.desc'))
			->get();
	
		$total=0;
		foreach($subjects as $s){
			$total+=$s->amount;
		}
		return view('admin.contacto.total',array("subjects"=>$subjects,"total"=>$total));
	}
}

<?php

use Illuminate\Database\Seeder;
use App\Subject;
use \Illuminate\Support\Facades\DB;

/**
ejecutar php artisan db:seed --class=subjectSeeder

*/
class subjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subject = new Subject();
	$subject->desc="reclamo";
	$subject->save();

	$subject2 = new Subject();
	$subject2->desc="solicitud";
	$subject2->save();

	$subject2 = new Subject();
	$subject2->desc="queja";
	$subject2->save();
    }
}

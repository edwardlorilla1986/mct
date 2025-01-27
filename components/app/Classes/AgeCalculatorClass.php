<?php 

namespace App\Classes;
use Carbon\Carbon;

class AgeCalculatorClass {

	public function get_data( $byear, $bmonth, $bday, $year, $month, $day )
	{

        try {

            $dateOfBirth = $byear . '-' . $bmonth . '-' . $bday;

            $currentDate = $year . '-' . $month . '-' . $day;

            $data['age'] = Carbon::parse($dateOfBirth)->diff($currentDate)->format('%y ' . __('year(s), ') . '%m ' . __('month(s) and ') . '%d ' . __('day(s)'));

            $data['months'] = Carbon::parse($dateOfBirth)->diffInMonths($currentDate);

            $data['weeks'] = Carbon::parse($dateOfBirth)->diffInWeeks($currentDate);

            $data['days'] = Carbon::parse($dateOfBirth)->diffInDays($currentDate);

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}

}
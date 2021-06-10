<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Random;
use App\Models\Breakdown;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function create()
    {
    	$randomIteration = rand(5, 10);
    	$breakdownIteration = rand(5, 10);

    	for($i = 0; $i < $randomIteration; $i++)
    	{
			$generator = \Nubs\RandomNameGenerator\All::create();
			echo $generator->getName();

			$random = new Random();
			$random->values = $generator->getName();
			$random->flag = 0;
			$random->save();

			for($a = 0; $a < $breakdownIteration; $a++)
			{
				$rand = Random::findOrFail($random->id);

				$randomStr = substr(md5(microtime()), 0, 5);
				$breakdowns = new Breakdown(['values' => $randomStr]);
				$rand->breakdowns()->save($breakdowns);
			}

    	}
    }

    public function show()
    {
    	$resultArr = [];
    	$randoms = Random::all();

    	foreach($randoms as $rand)
    	{
    		$breakdowns = Random::find($rand->id)->breakdowns;

    		foreach($breakdowns as $breakdown)
    		{
    			array_push($resultArr, $breakdown->values);
    		}
    	}

    	return response()->json($resultArr);
    }

    public function ui()
    {
    	return view('show');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users as user,
App\Models\Draw_number as dn,
App\Models\Winning as win;
use DB;

class DrawController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    // public function list_draw()
    // {

    //     $a = dn::all();
    //     return $a;
    // }

    // public function create_draw()
    // {
    //     $draws = ["2839", "2993", "9931", "0932", "9322", "1234", "3404", "5678", "3939", "9012", "3838", "4738", "0000", "3748", "9393", "3782", "8301", "0138"];

    //     foreach ($draws as $key => $value) {
    //         $dn = new dn;
    //         $dn->number = $value;
    //         $dn->save();
    //     }
    // }

    public function draw()
    {
        return view('/draws/draw');
    }

    public function drawing(Request $request)
    {

        if($request->prizeType == NULL) {
            return response()->json(['status' => false, 'message' => 'Prize type is required.', 'data' => '']);
        }

        $drawsQuery = dn::query();

        if($request->random) {

            if($request->prizeType == "1") {

                $drawsGroupingByUserID = $drawsQuery->groupBy('user_id')->select("user_id", DB::raw('count(*) as total'))->get()->toArray();

                foreach ($drawsGroupingByUserID as $key => $value) {

                    $newDraws[$value['user_id']] = $value['total'];

                }

                $grandsWinners = array_keys($newDraws,max($newDraws));

                $grandsWinnerWithWinningNo = dn::whereIn('user_id', $grandsWinners)->inRandomOrder()->first();

            } else {

                $drawsGroupingByUserID = $drawsQuery->groupBy('user_id')->select("user_id", DB::raw('count(*) as total'))->get()->toArray();

                $grandsWinners = [];

                foreach ($drawsGroupingByUserID as $key => $value) {

                    array_push($grandsWinners, $value['user_id']);

                }

                $grandsWinnerWithWinningNo = dn::whereIn('user_id', $grandsWinners)->inRandomOrder()->first();

            }

        } else {

            $grandsWinnerWithWinningNo = $drawsQuery->where('number', '=', $request->winning_number)->first();

        }

        if(isset($grandsWinnerWithWinningNo)) {

            $user = $grandsWinnerWithWinningNo->user()->get()->first()->toArray();

            win::create([

                'name' => $user['name'],
                'number' => $grandsWinnerWithWinningNo['number']

            ]);

            return response()->json(['status' => true, 'message' => 'Success.', 'data' => $user]);

        }

        return response()->json(['status' => false, 'message' => 'No record found.', 'data' => '']);
    }
}

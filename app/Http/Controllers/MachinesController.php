<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Machine;
use App\Models\Topic;
use App\Models\User;
use App\Models\Point;
use App\Models\Value;
use Auth;
use Flash;
use Charts;


class MachinesController extends Controller
{

    public function __construct()
      {
        $this->middleware('auth', ['except' => ['index', 'show']]);
      }

    public function index()
       {
         $machines = Machine::all();
         return view('machines.index', compact('machines'));
       }

    public function show($id)
       {
         $machine = Machine::findOrFail($id);
         $user   = $machine->user;
         $points = $machine->points;
         $topics = $machine->topics()->withoutDraft()->recent()->paginate(28);
         $authors = $machine->authors;
         return view('machines.show', compact('machine','user','topics','authors','points'));
       }

    public function search(Request $request)
      {
         $num =$request->input('point');
         if($num != null){
         $id = $request->input('machineid');
         $values = Value::where('point_id', $num )->get();
         $points = Point::findOrFail($num);
         //$name = $points->lists('name');
         $data = $values->lists('value')->toArray();
         $time = $values->lists('created_at')->toArray();
         $machine = Machine::findOrFail($id);
         $chart = Charts::create('line', 'highcharts')
             //->view('custom.line.chart.view') // Use this if you want to use your own template
             ->title( $machine->name )
             ->ElementLabel($points->name)
             ->labels($time)
             ->values($data)
             ->dimensions(1100,600)
             ->responsive(false);
         $user = Auth::user();
         $topic = new Topic;

         return view('machines.search',compact('num','values','id','machine','chart','topic','user','points'));
       }
       else{
         Flash::error("无该测点信息");
         return redirect()->back();
       }
      }


    public function subscribe($id)
       {
          $machine = Machine::findOrFail($id);
          Auth::user()->subscriber()->attach($machine->id);
          $machine->increment('subscriber_count', 1);
          Flash::success("订阅成功");
          //app(UserSubscribedBlog::class)->generate(Auth::user(), $blog);
          return redirect()->back();
       }

     public function unsubscribe($id)
       {
          $machine = Machine::findOrFail($id);
          Auth::user()->subscriber()->detach($machine->id);
          $machine->decrement('subscriber_count', 1);
          Flash::success("成功取消订阅");
          //app(UserSubscribedBlog::class)->remove(Auth::user(), $blog);
          return redirect()->back();
       }
}

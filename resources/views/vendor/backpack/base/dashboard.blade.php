@php
                use App\Charts\AdminChart;
                use App\Models\Room;
                
                
                $data = collect([]); // Could also be an array
                $labels = collect([]);
                
                for ($days_backwards = 7; $days_backwards >= 0; $days_backwards--) {
                    $data->push(Room::whereDate('last_cleaned', today()->subDays($days_backwards))->count());
                    $labels->push(today()->subDays($days_backwards)->format('m-d-Y'));
                }

                $chart = new AdminChart;
                $chart->labels($labels);
                $chart->dataset('Rooms Cleaned', 'line', $data)->lineTension(0);
                $chart->title("Cleaned in previous week.", 20, '#666', true, "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");
                $chart->displayLegend(false);
                $chart->height(200);
                $chart->width(200);
                
                $data = collect([]);
                $labels = collect([]);

                foreach(Room::oldest('last_checked')->where('last_checked','!=','null')->take(5)->get() as $room){
                
                    $data->push( date_diff(new DateTime($room->last_checked),today())->days );
                    if($room->user != null){
                        $labels->push($room->full_name . ' - ' . $room->user->name);
                    }else{
                        $labels->push($room->full_name . ' - Not assigned');
                    }
                
                }
                
                
                 $chart2 = new AdminChart;
                 $chart2->labels($labels);
                 $chart2->dataset('Days', 'bar' , $data);
                 $chart2->title("Days since last cleaned or checked.", 20, '#666', true, "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");
                 $chart2->displayLegend(false);
                 $chart2->height(200);
                 $chart2->width(200);
                 
                  
                $data = collect([]);
                $labels = collect([]);

                $data->push(Room::where('bulb_hours', '<', '1800')->count());
                
                $yellow = collect([]);
                $red = collect([]);
                $temp = collect([]);
               
                foreach(Room::where('bulb_hours', '>', '1800')->get() as $room){
                    $temp->push($room->full_name);
                    if($room->bulb_hours < 2000){
                        $yellow->push($room);
                    }else{
                         $red->push($room);   
                    }
                }
                
                $label2 = " < 2000 Hrs: ";
                foreach($yellow as $y){
                    $label2 = $label2 . $y->full_name . ', ';
                }
                
                $label3 = " > 2000 Hrs: ";
                foreach($red as $r){
                    $label3 = $label3 . $r->full_name . ', ';
                }
                
                $data->push($yellow->count());
                $data->push($red->count());
                
                
                 $chart3 = new AdminChart;
                 $chart3->labels(['> 1800 Hrs',$label2,$label3]);
                 $chart3->dataset('Rooms', 'doughnut' , $data)->options(['backgroundColor'=>array('rgba(63, 195, 128, 1)','rgba(244, 179, 80, 1)','rgba(246, 36, 89, 1)'),]);
                 $chart3->title("Bulbs good, nearing replacement, or past due.", 20, '#666', true, "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");
                 $chart3->height(200);
                 $chart3->width(200);
                 $chart3->minimalist(true);
                
                
                
@endphp
                

@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('backpack::base.dashboard') }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
<!--
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('backpack::base.login_status') }}</div>
                </div>

                <div class="box-body">{{ trans('backpack::base.logged_in') }}
                </div>
            </div>
        </div>
    </div>
-->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">Rooms Cleaned</div>
                </div>

                <div class="box-body">
                    {!! $chart->container() !!}
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
                    {!! $chart->script() !!}
                </div>
            </div>
        </div>
    </div>
 <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">Top Neglected Rooms</div>
                </div>

                <div class="box-body">
                    {!! $chart2->container() !!}
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
                    {!! $chart2->script() !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">Campus Bulb Hour Health</div>
                </div>

                <div class="box-body">
                    {!! $chart3->container() !!}
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
                    {!! $chart3->script() !!}
                </div>
            </div>
        </div>
    </div>
 <div class="row">
        <div class="col-md-12">
           
        </div>
    </div>
    
    
@endsection

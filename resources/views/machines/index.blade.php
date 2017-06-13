@extends('layouts.default')

@section('title')
{{ lang('Machine') }}_@parent
@stop

@section('content')

      @foreach ($machines as $machine)
          <div class="col-md-4">
            @include('machines._info')
         </div>
      @endforeach

@stop

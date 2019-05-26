@extends('SharedLayout.app')
@section('AllDapocontent')
    <h1>{{$title}}</h1>
    
    @if($servicesAnyname > 0)
        <ul class="list-group">
            @foreach($servicesAnyname as $serviceItemsInArray)
                <li class="list-group-item">{{$serviceItemsInArray}}</li>
            @endforeach
        </ul>

    @endif
    
@endsection
  
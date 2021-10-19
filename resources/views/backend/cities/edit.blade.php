@extends('layouts.backend')
@section('content')
    <h1>Edit {{$city->name}}</h1>
    <form {{$novalidate}} method="POST" value="{{$city->name}}"
          action="{{route('cities.update',['id'=>$city->id])}}">
        <h3>Name * </h3>
        <input class="form-control" type="text" required name="name"><br>
        <button class="btn btn-primary" type="submit">Create</button>
        {{csrf_field()}}
        {{method_field('PUT')}}
    </form>

@endsection





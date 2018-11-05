@extends('layouts.app')

@section('content')
<postit-board :user="{{Auth::user()}}"></postit-board>
@endsection

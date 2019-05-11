@extends('layouts.app')

@section('main')
  {{ Auth::user()->requests }}
@endsection

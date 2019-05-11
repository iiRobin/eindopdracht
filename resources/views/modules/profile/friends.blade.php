@extends('layouts.app')

@section('main')
  {{ Auth::user()->friends }}
@endsection

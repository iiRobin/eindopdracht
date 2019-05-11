@extends('layouts.app')

@section('main')
  <group-chat :user="{{ auth()->user() }}"></group-chat>
@endsection

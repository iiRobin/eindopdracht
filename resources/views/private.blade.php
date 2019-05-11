@extends('layouts.app')

@section('main')
  <private-chat :user="{{ auth()->user() }}"></private-chat>
@endsection

@extends('admin.layout')

@section('content')
	<h1>Dashboad</h1>
	<p>Usuario logueado: {{ auth()->user()->name }}</p>
@endsection

@include('admin.dialogs._create_post')
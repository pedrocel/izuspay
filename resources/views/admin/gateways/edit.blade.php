@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Editar Gateway: {{ $gateway->name }}</h1>
    <form action="{{ route('admin.gateways.update', $gateway) }}" method="POST">
        @method('PUT')
        @include('admin.gateways._form')
    </form>
</div>
@endsection

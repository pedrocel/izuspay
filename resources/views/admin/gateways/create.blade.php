@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Novo Gateway</h1>
    <form action="{{ route('admin.gateways.store') }}" method="POST">
        @include('admin.gateways._form')
    </form>
</div>
@endsection

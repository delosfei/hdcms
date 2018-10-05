@extends('layouts.admin')
@section('menu')
    @include('chat.layouts.menu')
@endsection
@section('content')
    <form action="{{route('chat.base.store')}}" method="post">
        @csrf
        @include('chat.layouts._base')
    </form>
@endsection

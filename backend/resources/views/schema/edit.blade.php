@extends('layouts.app')

@section('head_title')
{{ $schema->title }}
@endsection

@section('content')
<livewire:schema-detaile :schema="$schema">
@endsection
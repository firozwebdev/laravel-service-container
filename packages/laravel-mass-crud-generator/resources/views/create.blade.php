@extends('layouts.app')

@section('content')
    <h1>Create {{ $modelSingular }}</h1>
    <form action="{{ route('{{ $modelLower }}.store') }}" method="POST">
        @csrf
        @foreach($fields as $field)
            <div>
                <label>{{ ucfirst($field) }}</label>
                <input type="text" name="{{ $field }}" required>
            </div>
        @endforeach
        <button type="submit">Create</button>
    </form>
@endsection

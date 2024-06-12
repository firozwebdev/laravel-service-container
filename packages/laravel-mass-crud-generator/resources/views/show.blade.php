@extends('layouts.app')

@section('content')
    <h1>{{ $modelSingular }} Details</h1>
    <div>
        @foreach($fields as $field)
            <p><strong>{{ ucfirst($field) }}:</strong> {{ $model->$field }}</p>
        @endforeach
    </div>
    <a href="{{ route('{{ $modelLower }}.edit', $model->id) }}">Edit</a>
    <form action="{{ route('{{ $modelLower }}.destroy', $model->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection

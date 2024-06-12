@extends('layouts.app')

@section('content')
    <h1>Edit {{ $modelSingular }}</h1>
    <form action="{{ route('{{ $modelLower }}.update', $model->id) }}" method="POST">
        @csrf
        @method('PUT')
        @foreach($fields as $field)
            <div>
                <label>{{ ucfirst($field) }}</label>
                <input type="text" name="{{ $field }}" value="{{ $model->$field }}" required>
            </div>
        @endforeach
        <button type="submit">Update</button>
    </form>
@endsection

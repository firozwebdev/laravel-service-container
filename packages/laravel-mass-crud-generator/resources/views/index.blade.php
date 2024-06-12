@extends('layouts.app')

@section('content')
    <h1>{{ $modelPlural }} List</h1>
    <a href="{{ route('{{ $modelLower }}.create') }}">Create New {{ $modelSingular }}</a>
    <table>
        <thead>
            <tr>
                @foreach($fields as $field)
                    <th>{{ ucfirst($field) }}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($models as $model)
                <tr>
                    @foreach($fields as $field)
                        <td>{{ $model->$field }}</td>
                    @endforeach
                    <td>
                        <a href="{{ route('{{ $modelLower }}.show', $model->id) }}">View</a>
                        <a href="{{ route('{{ $modelLower }}.edit', $model->id) }}">Edit</a>
                        <form action="{{ route('{{ $modelLower }}.destroy', $model->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

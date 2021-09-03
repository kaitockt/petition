@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">@yield('title')</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Show errors if any --}}
            @if ($errors->any())
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>Error(s)</strong>
                    </div>
                    <div class="card-body">
                        @foreach($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </div>
                </div>
            @endif
            
            {{-- Edit Petition --}}
            @if (isset($petition))
                <form action="{{ route('petition.update', ['petition'=> $petition]) }}" method="POST">
                    {{ method_field('PUT') }}
            @else
            <form action="{{ route('petition.store') }}" method="POST">
            @endif
            @csrf

            {{-- Title --}}
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" placeholder="Title of the Petition" name="title" required="required"
            @if (isset($petition->title))
                value="{{ $petition->title }}"
            @endif
            >

            {{-- Description --}}
            <label for="description">Description:</label>
            <textarea class="form-control" rows="5" id="description" placeholder="Add a description..." name="description"
            >@if (isset($petition->description)){{ $petition->description }}@endif</textarea>

            <button class="btn btn-primary btn-block mt-3">
                Submit
            </button>
            </form>
        </div>
    </div>
</div>
@endsection
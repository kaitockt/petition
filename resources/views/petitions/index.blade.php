@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">My Petitions</h1>
    <div id="accordion">
        @forelse($petitions as $petition)
        {{-- <a class="list-group-item list-group-item-action"
            href="{{ route('petition.show', ['petition' => $petition->id]) }}">
            {{ $petition->title }} 
        </a> --}}
        <div class="card">
            <div class="card-header">
                <a href="#collapse{{ $petition->id }}" class="collapsed card-link" data-toggle="collapse">
                    {{ $petition->title }} 
                </a>
            </div>
            <div id="collapse{{ $petition->id }}" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    <p>{{ $petition->description }}</p>
                    <p id="signers">Number of Signers: {{ count($petition->signers) }}</p>
                    <div class="d-flex justify-content-between">
                        {{-- Edit --}}
                        <a href="{{ route('petition.edit', ['petition' => $petition->id]) }}"
                            class="btn btn-primary">
                            Edit
                        </a>

                        {{-- Delete --}}
                        <form action="{{ route('petition.destroy', ['petition' => $petition->id]) }}" method="POST" id="delete">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="button" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </div>
    <a href="{{ route('petition.create') }}"  class="btn btn-primary btn-block mt-4">
        New Petition
    </a>
</div>
@endsection
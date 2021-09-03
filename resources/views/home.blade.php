@extends('layouts.app')

@section('content')
<div class="container justify-content-center">
    <h1 class="text-center">All Petitions</h1>
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
                    <div class="d-flex justify-content-between">
                        <p id="signers">Number of Signers: {{ count($petition->signers) }}</p>
                        <p id="created-at">Created At: {{ $petition->created_at }}</p>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        {{-- One-Click Sign --}}
                        @if ($petition->signers->contains(Auth::user()))
                            <p>You signed this petition.</p>
                        @else
                            <form action="{{ route('petition.sign', ['petition' => $petition]) }}" method="POST">
                                @csrf
                                {{ method_field('PUT') }}
                                <button class="btn btn-success">
                                    Sign Now
                                </button>
                            </form>
                        @endif
                        {{-- Show Details --}}
                        <a href="{{ route('petition.show', ['petition' => $petition]) }}"
                            class="btn btn-primary">
                            Details
                        </a>
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

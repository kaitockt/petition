@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Title --}}
    <h1 class="text-center mb-3">{{ $petition->title }}</h1>
    <div class="d-flex justify-content-between">
        {{-- Creator --}}
        <p id="creator">Created By: {{ $petition->creator->name }}</p>
        {{-- Created At --}}
        <p id="created-at">Created At: {{ $petition->created_at }}</p>
    </div>
    {{-- Description --}}
    <p id="description">{{ $petition->description }}</p>
    {{-- Signers --}}
    <strong>Signers:</strong>
    <p id="signers">
        @forelse ($petition->signers as $signer)
            {{-- If not printing the last one, add a comma behind it --}}
            {{ $signer->name.($loop->last?'':', ') }}
        @empty
            No signer for the moment.
        @endforelse
    </p>
    
    {{-- Buttons --}}

    {{-- Sign --}}
    @if ($petition->signers->contains(Auth::user()))
        <p>You already signed this petition.</p>
    @else
        <form action="{{ route('petition.sign', ['petition' => $petition]) }}" method="POST">
            @csrf
            {{ method_field('PUT') }}
            <button class="btn btn-primary btn-block btn-lg mb-3">
                Sign Now
            </button>
        </form>
    @endif
    {{-- Edit --}}
    @if ($petition->creator == Auth::user())
        <a href="{{ route('petition.edit', ['petition' => $petition]) }}"
            class="btn btn-secondary btn-block btn-lg">
            Edit
        </a>
    @endif
</div>
@endsection
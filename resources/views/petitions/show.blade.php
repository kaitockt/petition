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
            {{ $loop->first?'':', ' }}
            {{ $signer->name }}
        @empty
            No signer for the moment.
        @endforelse
    </p>
    
    {{-- Buttons --}}

    {{-- Sign --}}
    @if ($petition->signers->contains(Auth::user()))
        <p>You already signed this petition.</p>
    @else
        <a href="{{ route('petition.sign', ['petition' => $petition]) }}"
            class="btn btn-primary btn-block btn-lg">
            Sign Now
        </a>
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
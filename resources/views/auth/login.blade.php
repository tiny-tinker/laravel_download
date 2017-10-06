@extends('layouts.app')

@section('content')
    @if (session('activationStatus'))
        <div class="alert alert-success">
            {{ trans('auth.activationStatus') }}
        </div>
    @endif

    @if (session('activationWarning'))
        <div class="alert alert-warning">
            {{ trans('auth.activationWarning') }}
        </div>
    @endif
@endsection

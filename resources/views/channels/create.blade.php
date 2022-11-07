@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Add Channel</div>

    <div class="card-body">
        <form action="{{route('channels.store')}}" method="POST">

            @csrf

            <div class="form-group mb-2">
                <label for="title">Name</label>
                <input type="text" id="name" class="form-control" name="name">
                @error('name')
                    <span class="text-danger fw-bold">{{$message}}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Create Channel</button>

        </form>

    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Add Discussion</div>

    <div class="card-body">
        <form action="{{route('discussions.store')}}" method="POST">

            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" class="form-control" name="title">
                @error('title')
                    <span class="text-danger fw-bold">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <input id="content" type="hidden" name="content">
                <trix-editor input="content"></trix-editor>
                @error('content')
                    <span class="text-danger fw-bold">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="channel">Channel</label>
                <select name="channel" id="channel" class="form-control">
                    <option value="" selected>====Select Channel====</option>
                    @foreach ($channels as $channel)
                        <option value="{{$channel->id}}">{{$channel->name}}</option>
                    @endforeach
                </select>
                @error('channel')
                    <span class="text-danger fw-bold">{{$message}}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Create Discussion</button>

        </form>

    </div>
</div>
@endsection


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
@endsection

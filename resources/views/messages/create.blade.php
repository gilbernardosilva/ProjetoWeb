@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-danger">Create a new message</h1>
                <form action="{{ route('messages.store') }}" method="post">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label">Subject</label>
                            <input type="text" class="form-control" name="subject" placeholder="Subject"
                                value="{{ old('subject') }}">
                        </div>

                        <!-- Message Form Input -->
                        <div class="form-group">
                            <label class="control-label">Message</label>
                            <textarea name="message" class="form-control">{{ old('message') }}</textarea>
                        </div>

                        @if ($users->count() > 0)
                             <div class="form-group">
                                <select name="user_id" id="user_id" class="form-select">
                                    @foreach ($users as $user)
                                    @if($user->role == "seller")
                                        <option type="checkbox" name="recipients[]" value="{{ $user->id }}">
                                            {{ $user->name }}</option>
                                            @endif()
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
            @stop

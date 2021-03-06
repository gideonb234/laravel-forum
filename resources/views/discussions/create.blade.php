@extends('forum::layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('forum::create_discussion') }}</div>

        <div class="panel-body">
            <form action="{{ route('forum.discussions.store') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
                    <label for="group_id">{{ trans('forum::groups_singular') }}</label>
                    <select name="group_id" id="group_id" class="form-control">
                        <option selected disabled>-</option>

                        @if (count($groups))
                            @foreach($groups as $key => $group)
                                <option value="{{ $group->id }}"{{ (old('group_id') == $group->id) ? ' selected' : '' }}>{{ $group->name }}</option>

                                @if ($group->descendants->count())
                                    @foreach ($group->descendants as $descendant)
                                        <option value="{{ $descendant->id }}"{{ (old('group_id') == $descendant->id) ? ' selected' : '' }}>{{ $descendant->name }}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    </select>

                    @error('group_id')
                </div>

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">{{ trans('forum::label_title') }}</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">

                    @error('title')
                </div>

                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    <label for="content">{{ trans('forum::label_content') }}</label>
                    <textarea name="content" id="content" class="form-control" rows="12">{{ old('content') }}</textarea>

                    @error('content')
                </div>

                <button class="btn btn-success">{{ trans('forum::submit') }}</button>
            </form>
        </div>
    </div>
@endsection

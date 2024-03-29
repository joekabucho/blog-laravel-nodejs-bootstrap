@extends('admin.layouts.app')
@section('title','Tags')
@section('content')
@section('action')
    <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#add-tag-modal">New</button>
@endsection
    <table class="table table-striped">
        <thead>
        <tr>
            <th>name</th>
            <th>article</th>
            <th>operating</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->name }}</td>
                <td>{{ $tag->posts_count }}</td>
                <td>
                    <a href="{{ route('tag.edit',$tag->id) }}" class="btn btn-info"
                       data-toggle="tooltip" data-placement="top" title="edit">
                        <i class="fa fa-pencil fa-fw"></i>
                    </a>
                    <button type="submit"
                            data-toggle="tooltip"
                            class="btn btn-danger swal-dialog-target"
                            data-dialog-msg="confirm delete{{ $tag->name }}？"
                            data-url="{{ route('tag.destroy',$tag->id) }}"
                            title="delete">
                        <i class="fa fa-trash-o fa-fw"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('admin.modals.add-tag-modal')
@endsection

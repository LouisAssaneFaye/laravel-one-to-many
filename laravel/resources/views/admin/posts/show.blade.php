@extends('layouts.app')
@section('content')
<div class="container" id="posts-container">
    <div class="col-12">
                <ul>
                    <li>
                        {{$post->id}}
                    </li>
                    <li>
                    {{$post->title}}
                    </li>
                    <li>
                    {{$post->slug}}
                    </li>
                    <li>
                    {{$post->content}}
                    </li>
                    <li>
                        <a href="" class="btn btn-sm btn-primary">
                            View
                        </a>
                        <a href="" class="btn btn-sm btn-success">
                            Edit
                        </a>
                        <form classs="d-inline-block" action="{{route('admin.posts.destroy', $post)}}" method="POST">
                            @csfr
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-warning">
                                Delete
                            </button>
                        </form>    
                    </li>
                </ul>
    </div>

</div>          
           

@endsection
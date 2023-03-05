@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="card mb-2">
      <div class="card-body">
        <h5 class="card-title">{{ $article->title }}</h5>
        <div class="card-subtitle mb-2 text-muted small">
          {{ $article->created_at->diffForHumans() }},
          Category: <b>{{ $article->category->name }},</b>
          Author: <b>{{ $article->user->name }}</b>
        </div>
        <p class="card-text">{{ $article->body }}</p>
        @if (auth()->user()->id == $article->user_id)
          <a class="btn btn-warning" href="{{ url("/articles/delete/$article->id") }}">
            Delete
          </a>
          <a class="btn btn-info" href="{{ url("/articles/edit/$article->id") }}">
            Edit
          </a>
        @endif
      </div>
    </div>

    <ul class="list-group">
      <li class="list-group-item active">
        <b>Comments ({{ count($article->comments) }})</b>
      </li>
      @foreach ($article->comments as $comment)
        <li class="list-group-item">
          <div class="card position-relative">
            <div class="card-content p-4">
              {{ $comment->content }}
            </div>
            @if (auth()->user()->id == $comment->user_id)
              <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close position-absolute top-0 end-0 p-2">
              </a>
            @endif
            <div class="card-footer">
              By <b>{{ $comment->user->name }}</b>,
              {{ $comment->created_at->diffForHumans() }}
            </div>
          </div>
        </li>
      @endforeach
    </ul>

    @auth

      <form action="{{ url('/comments/add') }}" method="post">
        @csrf
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
        <input type="submit" value="Add Comment" class="btn btn-secondary">
      </form>
    @endauth
  </div>
@endsection

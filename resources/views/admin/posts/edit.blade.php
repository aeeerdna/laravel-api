@extends('layouts.dashboard')

@section('content')
    @if ($errors->any())
        <div class="row">
            <div class="col-12 bg-danger">
                Error
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.posts.update', $post->id) }}">
        @csrf
        @method('PATCH')
        <div @error('title') class="is-invalid" @enderror>
            <label for="title">Title:</label>
            <input type="text" required minlength="5" maxlength="255" name="title"
                value="{{ old('title', $post->title) }}">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <!-- categorie -->
        <div @error('category_id') class="is-invalid" @enderror>
            <label for="category_id">Category: </label>
            <select name="category_id">
                <option value="">None</option>
                <option value="150" {{ 150 == old('category_id', $post->category_id) ? 'selected' : '' }}>TEST
                </option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div @error('content') class="is-invalid" @enderror>
            <label for="content">Content:</label>
            <textarea name="content" required cols="30" rows="10">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- tags -->
        @if ($errors->any())
            <div @error('tags') class="is-invalid" @enderror>
                <label>Tags:</label>
                @foreach ($tags as $tag)
                    <input {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} type="checkbox" name="tags[]"
                        value={{ $tag->id }}>
                @endforeach
                <label>{{ $tag->name }}</label>
            </div>
        @else
            <div>
                <label>Tags:</label>
                @foreach ($tags as $tag)
                    <input {{ $post->tags->contains($tag) ? 'checked' : '' }} type="checkbox" name="tags[]"
                        value="{{ $tag->id }}">
                    <label>{{ $tag->name }}</label>
                @endforeach
            </div>
        @endif

        <div>
            <input type="submit" value="Upload">
        </div>
    </form>
@endsection

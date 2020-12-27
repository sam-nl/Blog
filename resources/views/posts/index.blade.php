<h1>Posts</h1>
@forelse($posts as $post)
    <p>{{ $post->content}}</p>
@empty
    <p>empty</p>
@endforelse
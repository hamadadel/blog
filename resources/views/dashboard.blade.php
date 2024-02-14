<x-layout>
  <div class="container py-md-5 container--narrow">
    @unless($posts->isEmpty())
      <div class="list-group">
          @foreach ($posts as $post)
            <a href="/posts/{{ $post->slug }}" class="list-group-item list-group-item-action">
              <img src="{{ asset($post->user->avatar) }}" alt="avatar" class="avatar-tiny" />
            <strong>{{ $post->title }}</strong>
              <span class="text-muted small">
                by {{ $post->user->username }}
                   {{ $post->created_at->diffForHumans() }}
              </span>
            </a> 
          @endforeach
      </div>
   @else
    <div class="text-center">
      <h2>Hello <strong>{{ auth()->user()->name }}</strong>, your feed is empty.</h2>
      <p class="lead text-muted">Your feed displays the latest posts from the people you follow. If you don&rsquo;t have any friends to follow that&rsquo;s okay; you can use the &ldquo;Search&rdquo; feature in the top menu bar to find content written by people with similar interests and then follow them.</p>
    </div>
  @endunless
  </div>
</x-layout>
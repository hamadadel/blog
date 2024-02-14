<x-layout>
	<div class="container py-md-5 container--narrow">
        <h2>
          <img class="avatar-small" src="{{ asset($user->avatar) }}" /> 
          {{ $user->name }}
          @if(auth()->id() !== $user->id)
            <form class="ml-2 d-inline" action="/follow/{{ $user->username }}" method="POST">
              @csrf
              <button class="btn btn-primary btn-sm">
                {{ auth()->user()->isFollowing($user) ? 'UnFollow':'Follow' }}
                <i class="fas fa-user-plus"></i></button>
              <!-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> -->
            </form>
          @else(auth()->id() === $user->id)
            <a href="/avatar" class="btn btn-secondary btn-sm">update avatar</a>
          @endif
        </h2>
  
        <div class="profile-nav nav nav-tabs pt-2 mb-4">
          <a href="/posts/{{ $user->username }}" class="profile-nav-link nav-item nav-link {{ Request::segment(2)=== $user->username ? 'active':'' }}">Posts: {{ $user->posts->count() }}</a>
          <a href="/{{ $user->username }}/followers" class="profile-nav-link nav-item nav-link {{ Request::segment(2)=== 'followers' ? 'active':'' }}">Followers: {{ $user->followers->count() }}</a>
          <a href="/{{ $user->username }}/following" class="profile-nav-link nav-item nav-link {{ Request::segment(2)=== 'following' ? 'active':'' }}">Following: {{ $user->following->count() }}</a>
        </div>
		<div class="list-group">
			@foreach ($user->posts as $post)
				<a href="/posts/{{ $post->slug }}" class="list-group-item list-group-item-action">
				<strong>{{ $post->title }}</strong> {{ $post->created_at }}
				</a> 
			@endforeach
		</div>
      </div>
</x-layout>
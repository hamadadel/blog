<x-layout title="{{ $user->username }} Follows">
    @if($user->following->count())
        <div class="container py-md-5 container--narrow">
            <h2>
                you following 
            </h2>
    
            {{-- <div class="profile-nav nav nav-tabs pt-2 mb-4">
            <a href="/posts/{{ $user->username }}" class="profile-nav-link nav-item nav-link {{ Request::segment(2)=== $user->username ? 'active':'' }}">Posts: {{ $user->posts->count() }}</a>
            <a href="/{{ $user->username }}/followers" class="profile-nav-link nav-item nav-link {{ Request::segment(2)=== 'followers' ? 'active':'' }}">Followers: 3</a>
            <a href="/{{ $user->username }}/following" class="profile-nav-link nav-item nav-link {{ Request::segment(2)=== 'following' ? 'active':'' }}">Following: 2</a>
            </div> --}}
            <div class="list-group">
                @foreach ($user->following as $followed)
                <a href="/profile/{{ $followed->username }}" class="list-group-item list-group-item-action">
                    <img class="avatar-small" src="{{ asset($followed->avatar) }}">
                    <strong>{{ $followed->name }}</strong> 
                    </a> 
                @endforeach
            </div>
        </div>
      @else
        <div class="container container-narrow">
            <div class="alert alert-info text-center">
                you don't follow any user
            </div>
        </div>
      @endif
</x-layout>
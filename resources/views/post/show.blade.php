<x-layout :title="$post->title" >
    <div class="container py-md-5 container--narrow">
        <div class="d-flex justify-content-between">
          <h2>{{ $post->title }}</h2>
        @can('delete',$post)
            <span class="pt-2">
              <a href="/posts/{{ $post->slug }}/edit" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
              <form class="delete-post-form d-inline" action="/posts/{{ $post->slug }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
              </form>
            </span>
          @endcan
        </div>
  
        <p class="text-muted small mb-4">
          <a href="#"><img class="avatar-tiny" src="https://gravatar.com/avatar/f64fc44c03a8a7eb1d52502950879659?s=128" /></a>
          Posted by <a href="/profile/{{ $post->user->username }}">{{ $post->user->name }}</a> on {{ $post->created_at }}
        </p>
           
        <div class="body-content">
            {!! $post->content !!}
        </div>
      </div>
</x-layout>
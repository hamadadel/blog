<div class="flex-row my-3 my-md-0">
    <a href="#" class="text-white mr-2 header-search-icon" title="Search" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-search"></i></a>
    <span class="text-white mr-2 header-chat-icon" title="Chat" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-comment"></i></span>
    <a href="#" class="mr-2"><img title="My Profile" data-toggle="tooltip" data-placement="bottom" style="width: 32px; height: 32px; border-radius: 16px" src="https://gravatar.com/avatar/f64fc44c03a8a7eb1d52502950879659?s=128" /></a>
    <a class="btn btn-sm btn-success mr-2" href="/post/create">Create Post</a>
    <form action="/auth/logout" method="POST" class="d-inline">
        @csrf
        <button class="btn btn-sm btn-secondary">Sign Out</button>
    </form>
</div>
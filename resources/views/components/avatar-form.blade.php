 <div class="container container-narrow py-md-5">
    <h2 class="text-center mb-3">Upload an Avatar</h2>
    <form action="/avatar" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="file" name="avatar" required>
            @error('avatar')
            <p class="alert small alert-danger shadow-sm">
                {{ $message }}
            </p>
            @enderror
        </div>
        <button class="btn btn-secondary btn-sm" type="submit">Save</button>
    </form> 
</div>
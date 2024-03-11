<x-admin.layout>
    <x-admin.breadcrumb title='Metatags Edit' :links="[
        ['text' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['text' => 'Metatags', 'url' => route('admin.metatags.index')],
        ['text' => 'Edit'],
    ]" :actions="[
        [
            'text' => 'All metatags',
            'icon' => 'fas fa-list',
            'url' => route('admin.metatags.index'),
            'class' => 'btn-success btn-loader',
        ],
        [
            'text' => 'Add metatag',
            'icon' => 'fas fa-plus',
            'url' => route('admin.metatags.create'),
            'class' => 'btn-success',
        ],
    ]" />

    <form action="{{ route('admin.metatags.update', [$metatag, 'global' => $metatag->is_global]) }}" method="POST"
        id="tags_form">
        @csrf
        @method('PUT')
        @if ($metatag->url)
            <div class="card shadow-sm mb-2">
                <div class="card-body table-responsive">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">URL:</span>
                        </div>
                        <input type="url" class="form-control" name="url" value="{{ $metatag->url }}" required>
                    </div>
                </div>
            </div>
        @endif

        <div class="row" id="tags_row">
            @foreach ($metatag->tags as $tag)
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm mb-2" id="{{ $loop->iteration == 1 ? 'first_tag' : '' }}">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="">Meta tag <span class="text-danger">*</span></label>
                            <div class="d-flex">
                                <div class="flex-fill">
                                    <input type="text" name="tags[]" class="form-control" value="{{ $tag['name'] }}" required>
                                </div>
                                <button type="button" class="btn btn-danger tag_remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label for="">Content <span class="text-danger">*</span></label>
                            <textarea name="contents[]" class="form-control" rows="2" required>{{ $tag['content'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- @foreach ($metatag->tags as $tag)
            <div class="card shadow-sm mb-2" id="{{ $loop->iteration == 1 ? 'first_tag' : '' }}">
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Meta tag <span class="text-danger">*</span></span>
                            </div>
                            <input type="text" name="tags[]" class="form-control" value="{{ $tag['name'] }}"
                                required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-danger tag_remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Content <span class="text-danger">*</span></span>
                            </div>
                            <textarea name="contents[]" class="form-control" rows="2" required>{{ $tag['content'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach --}}
        <div class="card shadow-sm" id="tags_action">
            <div class="card-body d-flex justify-content-between">
                <button type="submit" class="btn btn-dark">
                    <i class="fas fa-save"></i> Submit
                </button>
                <button type="button" class="btn btn-info" id="add_tag">
                    <i class="fas fa-plus"></i> New Tag
                </button>
            </div>
        </div>
    </form>

    @push('styles')
        <style>
            #first_tag .tag_remove{ display: none; }
        </style>
    @endpush

    @push('scripts')
        <script>
            $(document).ready(function() {

                var tagHtml = $("#first_tag").html();
                tagHtml = '<div class="col-lg-4 col-md-6"><div class="card shadow-sm mb-2">' + tagHtml + '</div></div>';

                //$("#first_tag .tag_remove").parent().remove();

                $("#add_tag").click(function(event) {
                    $("#tags_row").append(tagHtml);
                });

                $("#tags_form").on('click', '.card-body:not(#first_tag) .tag_remove', function(event) {
                    event.preventDefault();
                    $(this).closest('.col-lg-4').remove();
                });

            });
        </script>
    @endpush
</x-admin.layout>

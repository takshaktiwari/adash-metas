<x-admin.layout>
    <x-admin.breadcrumb title='Metatags Show' :links="[
        ['text' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['text' => 'Metatags', 'url' => route('admin.metatags.index')],
        ['text' => 'Show'],
    ]" :actions="[
        [
            'text' => 'Add metatag',
            'icon' => 'fas fa-plus',
            'url' => route('admin.metatags.create'),
            'class' => 'btn-success',
        ],
        [
            'text' => 'All metatags',
            'icon' => 'fas fa-list',
            'url' => route('admin.metatags.index'),
            'class' => 'btn-dark',
        ],
    ]" />

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table mb-0">
                <tbody>
                    <tr>
                        <td><b>URL:</b></td>
                        <td>
                            @if ($metatag->url)
                                <a href="{{ $metatag->url }}" target="_blank">
                                    {{ $metatag->url }}
                                </a>
                            @else
                                <h5 class="my-auto">Global Tags</h5>
                            @endif
                        </td>
                    </tr>
                    @foreach ($metatag->tags as $tag)
                        <tr>
                            <td><b>{{ $tag['name'] }}:</b></td>
                            <td>{{ $tag['content'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.metatags.edit', [$metatag]) }}" class="btn btn-success">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('admin.metatags.destroy', [$metatag]) }}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger delete-alert">
                    <i class="fas fa-trash"></i> Destroy
                </button>
            </form>
        </div>
    </div>
</x-admin.layout>

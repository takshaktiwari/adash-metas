<x-admin.layout>
	<x-admin.breadcrumb
		title='Metatags'
		:links="[
			['text' => 'Dashboard', 'url' => route('admin.dashboard') ],
            ['text' => 'Metatags'],
		]"
        :actions="[
            ['text' => 'Add metatag', 'icon' => 'fas fa-plus', 'url' => route('admin.metatags.create'), 'class' => 'btn-success btn-loader'],
        ]" />

    <div class="card shadow-sm">
    	<div class="card-body table-responsive">
    		<table class="table mb-0">
    			<thead>
    				<th>#</th>
    				<th>Url</th>
    				<th>Action</th>
    			</thead>
    			<tbody>
    				@foreach($metatags as $metatag)
    				    <tr>
    				    	<td>{{ $loop->iteration }}</td>
    				    	<td>
                                <a href="{{ $metatag->url }}" target="_blank">
                                    {{ \Str::of($metatag->url)->after(url('/'))->__toString() ? \Str::of($metatag->url)->after(url('/')) : '/' }}
                                </a>
                            </td>
    				    	<td>
                                <a href="{{ route('admin.metatags.show', [$metatag]) }}" class="btn btn-info btn-sm load-circle">
                                    <i class="fas fa-info-circle"></i>
                                </a>
    				    		<a href="{{ route('admin.metatags.edit', [$metatag]) }}" class="btn btn-success btn-sm load-circle">
    				    			<i class="fas fa-edit"></i>
    				    		</a>
    				    		<form action="{{ route('admin.metatags.destroy', [$metatag]) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-alert">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
    				    	</td>
    				    </tr>
    				@endforeach
    			</tbody>
    		</table>
    	</div>
        <div class="card-footer">
            {{ $metatags->links() }}
        </div>
    </div>
</x-admin.layout>

<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="fas fa-code"></i>
        <span>Meta Tags</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a href="{{ route('admin.metatags.index') }}">Page Tags</a></li>
        <li><a href="{{ route('admin.metatags.index', ['global' => 1]) }}">Global Tags</a></li>
    </ul>
</li>

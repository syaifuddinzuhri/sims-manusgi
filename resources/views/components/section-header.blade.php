<div class="section-header">
    <h1>
        @if (!isset($index) || !$index)
            @if (isset($is_editing) && $is_editing)
                Form Edit
            @else
                Form Tambah
            @endif
        @else
            Data
        @endif
        {{ $title }}
    </h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item">
            @if (!isset($index) || !$index)
                @if (isset($is_editing) && $is_editing)
                    Form Edit
                @else
                    Form Tambah
                @endif
            @else
                Data
            @endif
            {{ $title }}
        </div>
    </div>
</div>

<div class="d-flex justify-content-between">
    <ul {{ $attributes->merge(['class' => 'breadcrumbs']) }}>
        {{ $slot }}
    </ul>
    @include('layouts.partials.search')
</div>

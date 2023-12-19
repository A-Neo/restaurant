<div id="products-container">
    @foreach($categories as $category)
        <x-category :category="$category" />
    @endforeach
</div>

@if ($products->hasMorePages())
    <div id="loading" style="display:none;">
        <p>Loading more products...</p>
    </div>
@endif

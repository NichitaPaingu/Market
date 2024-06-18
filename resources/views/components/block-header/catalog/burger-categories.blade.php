@props(['categories'])

<div class="can-d-catalog_categories">
    @foreach ($categories as $category)
    <a href="/category/{{$category->id}}" class="can_d_catalog_link">
        {!!$category->icon!!}<span>{{$category->name}}</span>
    </a>
    @endforeach
</div>
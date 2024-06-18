@props(['categories'])

<div class="can-header-catalog">
    <div class="can-header-catalog_links-burger-menu">
        <div class="can-d-catalog_inner">
            <x-burger-categories :categories="$categories">

            </x-burger-categories>
            <x-burger-content>
                
            </x-burger-content>            
        </div>
    </div>
    <div class="can-header-catalog-content">
        <x-burger-button>

        </x-burger-button>

        <x-catalog-links>
            
        </x-catalog-links>
    </div>
</div>
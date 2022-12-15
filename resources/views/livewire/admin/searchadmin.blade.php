<div id="search">
    <div class="search-bar">
        <input wire:model="searchinput" type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search" wire:click="search('{{$currentURL}}')"><i class="bi bi-search"></i></button>
    </div>
</div>

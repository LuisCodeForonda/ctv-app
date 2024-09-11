<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component {
    //
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Categorias > create</h1>
    @endslot
</div>

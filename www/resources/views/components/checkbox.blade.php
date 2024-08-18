@props([
    'id' => null,
    'label' => '',
    'name' => 'comments',
    'value' => 1,
    'checked' => false,
])


<div class="relative flex items-start gap-x-3">
    <div class="flex h-6 items-center">
        <!-- Campo oculto para enviar valor 0 quando checkbox não está marcado -->
        <input type="hidden" name="{{ $name }}" value="0">

        <!-- Checkbox -->
        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="checkbox"
            value="{{ $value }}"
            {{ $checked ? 'checked' : '' }}
            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
        >
    </div>
    <div class="text-sm leading-6">
        <label for="{{ $id }}" class="font-medium text-gray-900">
            {{ $label ?: 'Label' }}
        </label>
    </div>
</div>

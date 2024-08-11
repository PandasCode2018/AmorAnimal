@props(['id' => '', 'labelClass' => '', 'selectClass' => 'selectClass', 'label' => '', 'name' => '', 'options' => ''])
<div>
    <label for="{{ $id }}" class="form-label text-left w-full {{ $labelClass }}">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $id }}"
        class=" transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800  dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10  {{ $selectClass }}">
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" @if ($value == $selected) selected @endif>{{ $text }}
            </option>
        @endforeach
    </select>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            $('#select2').select2();

            $('#select2').on('change', function(e) {
                var data = $('#select2').select2("val");
                @this.set('selectedOption', data);
            });
        });
    </script>
@endpush

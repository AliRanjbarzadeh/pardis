<label class="radio-container">
    {{ $title }}
    <input type="radio" name="{{ $name }}" id="speciality-{{ $id }}" value="{{ $value }}" data-id="{{ $id }}" @checked($checked ?? false)>
	<span class="checkmark"></span>
</label>

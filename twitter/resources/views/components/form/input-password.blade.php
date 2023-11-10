@props(['name' => '', 'label' => '', 'value' => '', 'iconId' => '', 'required' => false])

<div class="mb-3">
    <label for={{ $name }} class="form-label">{{ $label }}</label>
    <div class="input-group">
        <input type="password" class="form-control @error($name) is-invalid @enderror" id={{ $name }}
            name={{ $name }}>
        <span class="input-group-text">
            <i class="fa fa-eye" id={{ $iconId }} style="cursor: pointer;"></i>
        </span>
        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Title</label>
    <input
        name="title"
        value="{{ old('title', $todo?->title) }}"
        class="form-control @error('title') is-invalid @enderror"
        required
    >
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" rows="5" class="form-control">{{ old('description', $todo?->description) }}</textarea>
</div>

<div class="form-check mb-3">
    <input type="hidden" name="status" value="0">
    <input
        class="form-check-input"
        type="checkbox"
        name="status"
        value="1"
        id="status"
        @checked(old('status', $todo?->status ?? true))
    >
    <label class="form-check-label" for="status">Active</label>
</div>

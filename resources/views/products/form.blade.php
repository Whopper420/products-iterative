@php
    $productName = $product->name ?? '';
    $productQuantity = $product->quantity ?? 0;
    $productDescription = $product->description ?? '';
    $productExpirationDate = $product->expiration_date ?? null;
    $productStatus = $product->status ?? 'active';
@endphp

<div>
    <label for="name">Produkta nosaukums</label>
    <input
        id="name"
        type="text"
        name="name"
        value="{{ old('name', $productName) }}"
        required
    >
    @error('name')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="quantity">Daudzums</label>
    <input
        id="quantity"
        type="number"
        name="quantity"
        min="0"
        step="1"
        value="{{ old('quantity', $productQuantity) }}"
        required
    >
    @error('quantity')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="description">Apraksts</label>
    <textarea
        id="description"
        name="description"
    >{{ old('description', $productDescription) }}</textarea>
    @error('description')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="expiration_date">Derīgs līdz</label>
    <input
        id="expiration_date"
        type="date"
        name="expiration_date"
        value="{{ old('expiration_date', $productExpirationDate?->toDateString() ?? '') }}"
    >
    @error('expiration_date')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="status">Statuss</label>
    <select id="status" name="status" required>
        @foreach (['active' => 'Aktīvs', 'inactive' => 'Neaktīvs', 'discontinued' => 'Beigties'] as $value => $label)
            <option value="{{ $value }}" {{ old('status', $productStatus) === $value ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
    @error('status')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

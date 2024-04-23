@if (isset($menuItem))
    <form
        id="edit-menu-item-form"
        style="display: flex; flex-direction: column; gap: 10px;"
        method="POST"
        action="/menu_items/{{ $menuItem->id }}"
        hx-swap-oob="true"
    >
        @method('PATCH')
        @csrf

        <input type="hidden" name="id" value="{{ $menuItem->id }}">

        <label style="margin-bottom: -10px" for="name" >Име артикул:</label>
        <input type="text" id="name" name="name" value="{{ $menuItem->name }}" required>

        <label style="margin-bottom: -10px" for="price_bgn">Цена (лв.):</label>
        <input type="text" id="price_bgn" value="{{ $menuItem->price_bgn }}" name="price_bgn" required>

        <input type="submit" value="Запиши">
    </form>
@else
    <form
        id="edit-menu-item-form"
        style="display: flex; flex-direction: column; gap: 10px;"
        method="POST"
        action="/menu_items"
        hx-swap-oob="true"
    >
        @csrf
        <label style="margin-bottom: -10px" for="name">Име артикул:</label>
        <input type="text" id="name" name="name" required>

        <label style="margin-bottom: -10px" for="price_bgn">Цена (лв.):</label>
        <input type="text" id="price_bgn" name="price_bgn" required>

        <input type="submit" value="Създай">
    </form>
@endif

@include('components.swal_errors')

@if (isset($table))
    <form
        id="edit-table-form"
        style="display: flex; flex-direction: column; gap: 10px;"
        method="POST"
        action="/tables/{{ $table->id }}"
        hx-swap-oob="true"
    >
        @method('PATCH')
        @csrf

        <input type="hidden" name="id" value="{{ $table->id }}">

        <label for="name" style="margin-bottom: -10px;"> Име на маса: </label>
        <input type="text" id="name" name="name" required value="{{$table->name}}">

        <label for="num-seats" style="margin-bottom: -10px;"> Брой места: </label>
        <input
            class="no-spinner"
            required
            type="number" id="num-seats" name="num-seats" min="1" max="40"
            value="{{$table->capacity}}">

        <input type="submit" value="Запиши промени">
    </form>
@else
    <form
        id="edit-table-form"
        style="display: flex; flex-direction: column; gap: 10px;"
        method="POST"
        action="/tables"
        hx-swap-oob="true"
    >
        @csrf
        <label for="name" style="margin-bottom: -10px;"> Име на маса: </label>
        <input type="text" id="name" name="name">

        <label for="num-seats" style="margin-bottom: -10px;"> Брой места: </label>
        <input
            class="no-spinner"
            type="number" id="num-seats" name="num-seats" min="1" max="40"
            value="1">

        <input type="submit" value="Създай маса">
    </form>
@endif

@include('components.swal_errors')

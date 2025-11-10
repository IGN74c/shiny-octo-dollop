@extends('layout.app')
@section('title', 'Страница заявок')
@section('content')
    <form method="post" class="mb-2">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Название курса</label>
            <input type="text" name="title" class="form-control" id="title">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Тип оплаты</label>
            <select class="form-select" id="type" name="type">
                <option value="card">Карта</option>
                <option value="phone">По телефону</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Добавить заявку</button>
    </form>

    @if ($orders != false)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Тип оплаты</th>
                    <th scope="col">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->title }}</td>
                        <td class="{{ $order->getStatusColor($order->status) }}">{{ $order->getStatus($order->status) }}</td>
                        <td>{{ $order->getType($order->type) }}</td>
                        <td>
                            @if ($order->status === 'new')
                                <form method="post" action="{{ route('orders.destroy', $order) }}">@csrf<button
                                        class="btn btn-danger">Удалить</button></form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h2>У вас нет заявок</h2>
    @endif
@endsection
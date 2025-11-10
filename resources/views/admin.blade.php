@extends('layout.app')
@section('title', 'Страница админ панели')
@section('content')
    @if ($orders != false)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Название</th>
                    <th scope="col">Пользователь</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Тип оплаты</th>
                    <th scope="col">Действие</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->title }}</td>
                        <td>{{ App\Models\User::find($order->user_id)['name'] }}</td>
                        <td class="{{ $order->getStatusColor($order->status) }}">{{ $order->getStatus($order->status) }}</td>
                        <td>{{ $order->getType($order->type) }}</td>
                        <td class="d-flex gap-2">
                            <form method="post" action="{{ route('admin.update', $order) }}" class="d-flex gap-2">
                                @csrf
                                <select class="form-select" name="type" id="type">
                                    <option value="new">Новая</option>
                                    <option value="process">В процессе</option>
                                    <option value="success">Завершено</option>
                                    <option value="canceled">Отменен</option>
                                </select>
                                <button class="btn btn-success text-nowrap">Cменить статус</button>
                            </form>
                            <form method="post" action="{{ route('admin.destroy', $order) }}">
                                @csrf
                                <button class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else
        <h2>Нет заявок</h2>
    @endif
@endsection
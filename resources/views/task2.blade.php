@extends('layout.app')

@section('title-block')Task 1
@endsection

@section('content')
	<div class="company-header">СОРТИРОВКА</div>
	<div class="company-text">
		<p>2.  Имеется массив числовых значений, например, [4, 5, 8, 9, 1, 7, 2]. В распоряжении есть функция array_swap(&$arr, $num) { … } которая меняет местами элемент на позиции $num и элемент на 0 позиции. Т.е. при выполнении array_swap([3, 6, 2], 2) на выходе получим [2, 6, 3]. Написать код, сортирующий произвольный массив по возрастанию, используя только функцию array_swap.
        </p><br>
	</div>
    <div>{{ $data }}</div>
@endsection





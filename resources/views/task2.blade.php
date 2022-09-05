@extends('layout.app')

@section('title-block')Task 1
@endsection

@section('content')
	<div class="company-header">СОРТИРОВКА</div>
	<div class="company-text">
		<p>2.  Имеется массив числовых значений, например, [4, 5, 8, 9, 1, 7, 2]. В распоряжении есть функция array_swap(&$arr, $num) { … } которая меняет местами элемент на позиции $num и элемент на 0 позиции. Т.е. при выполнении array_swap([3, 6, 2], 2) на выходе получим [2, 6, 3]. Написать код, сортирующий произвольный массив по возрастанию, используя только функцию array_swap.
        </p><br>
        <hr class="hr-horizontal-gradient">
	</div>
    <div class="company-text">
        <br>
        <p>Для решения задачи используем базовый алгоритм - сортировка пузырьком. На каждой итерации очередной наибольший элемент сдвигается в конец массива</p>

            <pre>
                <code class="language-php">function ft_array_sort (&$arr)
{
    $n = count($arr) - 1;
    while($n) {
        $max = 0;
        $i = $n;
        while ($i) {
            if($max < $arr[$i]) {
                $max = $arr[$i];
                array_swap($arr, $i);
                $i = $n;
            }
            $i--;
        }
        if ($max > $arr[$n]){
            array_swap($arr, $n);
        }
        $n--;
    }
}                </code>
            </pre>
    </div>
    <div class="company-text">
            <p>Для демонстрации работы сгенерируем массив случайных чисел, длиной до 100 элементов.</p>
            <br>
            @include('inc.messages')
            <form action="{{ route('task2.sortArr') }}" method="post">
		@csrf

		    <div class="form-group">
			    <label for="length">Введите длину массива:</label>
			    <input type="text" name="length" placeholder="100" id="length" class="form-control">
		    </div>
		    <button type="submit" class="btn btn-success">Отправить</button>
	    </form>
        <br>
        @if($data)
        <p>Исходный массив</p>
        @foreach($data as $key => $item)
            @if($key > 0)
            <p>Отсортированный массив</p>
            @endif
            <div class="code">
            @foreach($item as $item1)
            {{ $item1 }}
            @endforeach
            </div>
        @endforeach
        @endif
    </div>
@endsection





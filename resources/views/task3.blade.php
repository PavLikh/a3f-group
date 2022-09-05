@extends('layout.app')

@section('title-block')Task 1
@endsection

@section('content')
	<div class="company-header">ПАРСЕР</div>
	<div class="company-text">
		<p>Написать на PHP парсер html страницы (на входе url), который на выходе будет отображать количество и название всех используемых html тегов. Использование готовых парсеров и библиотек запрещено, включая модуль DOM.
(обязательно использование ООП подхода, демонстрирующее основные принципы структурирования и взаимодействия объектов
не нужно придерживаться принципа KISS, приветствуется преувеличение уровня абстракции)
</p><br>
		<p>Основная цель задания ”3” не получить верный ответ, а продемонстрировать какие либо навыки организации кода с использованием ООП. Допускаются предположения не описанные в задаче, оверкодинг.</p><br>
        <hr class="hr-horizontal-gradient">
	</div>
    <div class="company-text">
            <p>Форма.</p>
            <br>
            @include('inc.messages')
            <form action="{{ route('task3.showHtmlTags') }}" method="post">
		@csrf

		    <div class="form-group">
			    <label for="url">Введите url:</label>
			    <input type="text" name="url" placeholder="100" id="url" class="form-control">
		    </div>
		    <button type="submit" class="btn btn-success">Отправить</button>
	    </form>
        <br>
        @if($data)
        <p>Исходный массив</p>
        <div class="code">
        @foreach($data as $key => $item)
            <div>{{ $key }} - {{ $item }}</div>
        @endforeach
        </div>
        @endif
    </div>
@endsection

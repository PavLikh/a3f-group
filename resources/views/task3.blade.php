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
        <p>Реализуем паттерн внедерение зависимости (DI). Laravel предоставляет инструмент для реализации данного паттерна - Service Container. Создадим ParseHtmlService и опишем в нем методы парсинга.</p>
    </div>
    <pre>
        <code class="language-php">class ParseHtmlService
{
    public function start(string $html, string $method)
    {
        if(method_exists($this, $method)) {
            return $this->$method($html);
        }
    }

    /**
     * @param string $html
     * @return array
     */
    protected function getTegs(string $html)
    {
        $array = $this->countHtmlTegs($this->getAllTags($html));
        return $array;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function countHtmlTegs(array $data)
    {
        $array = [];
        $i = 0;
        while($i < count($data)) {
            $j = 0;
            foreach($array as $key => $val) {
                if ($data[$i] == $key) {
                    $val++;
                    $array[$key]++;
                    break;
                }
                $j++;
            }
            if($j == count($array)) {
                $array[$data[$i]] = 1;
            }
            $i++;
        }
        return $array;
    }

    /**
     * @param string $html
     * @return array
     */
    protected function getAllTags(string $html)
    {
        $array = [];
        $i = 0;
        $teg_nb = 0;
        $k = 0;
        $start = -1;
        $end = -1;
        while($i < strlen($html)){
            if($html[$i] == '<' && ($html[$i+1] != ' ' && $html[$i+1] != '!' && $html[$i+1] != '/')){
                if ($start < 0) {
                    $i++;
                }
                $start = 1;
            }
            if($start == 1){
                if($html[$i] != '>' && $html[$i] != ' '){
                    $array[$teg_nb][$k++] = $html[$i];
                }
            }
            if($start > 0 && ($html[$i] == '>' || $html[$i] == ' ')){
                $start = -1;
                $teg_nb++;
                $k = 0;
            }
            $i++;
        }
        $data;
        foreach($array as $val) {
            $data[] = implode('', $val);
        }
        return $data;
    }
}</code>
    </pre>
    <div class="company-text">
        <p>Зарегистрируем связывание в соответствующем провайдере ParseHtmlServiceProvider, после чего сможем вызывать экзмепояры класса в контроллерах.</p>
    </div>
    <pre>
        <code class="language-php">public function register()
    {
        $this->app->bind(ParseHtmlService::class, function ($app) {
            return new ParseHtmlService();
        });
    }</code>
    </pre>
    <div class="company-text">
        <p>Демонстрации работы парсера.</p>
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
        @if(!empty($data))
            <p>Исходный массив</p>
            <div class="code">
            @foreach($data as $key => $item)
                <div>{{ $key }} - {{ $item }}</div>
            @endforeach
            </div>
        @endif
    </div>
@endsection

@extends('layout.app')

@section('title-block')Task 1
@endsection

@section('content')
	<div class="company-header">БАЗА ДАННЫХ</div>
	<div class="company-text">
		<p>1. Спроектировать структуру таблиц(ы) для хранения Контактов, которые могут иметь друзей из этого же списка Контактов (в рамках задачи достаточно хранить только Имя Контакта). Если Контакт 2 является другом Контакта 1, это не означает, что Контакт 1 является другом Контакта 2.</p><br>
		<p>1.1. Написать запрос sql, отображающий список Контактов, имеющих больше 5 друзей.</p><br>
		<p>1.2. Написать запрос sql, отображающий все пары Контактов, которые дружат друг с другом. Исключить дубликаты.
		(задача на sql запросы, использование PHP запрещено).</p><br>
        <hr class="hr-horizontal-gradient">
	</div>
    <div class="company-text">
        <br>
        <p>Так как мы рассматриваем упрощенную теоретическую схему, для решения нам будет достаточно использовать структуру из 2х таблиц: contacts(id, name), friends(id, contact_id, friend_id), в одной будем хранить контакты, во второй пары контакт и все его друзья по id. Также во вторую таблицу добавим уникальный индекс(id контакта, id друга)</p>
        <br>
    </div>
    <img src="/images/structure_db.jpg" alt="structure" class="">
    <br>
    <img src="/images/friends_table.jpg" alt="structure" class="">

    <div class="company-text">
    <br>
    <p>Запрос sql, отображающий список Контактов, имеющих больше 5 друзей.</p>
    </div>
        <pre>
            <code class="language-sql">SELECT contacts.name FROM contacts
JOIN
(SELECT `contact_id` FROM `friends` GROUP BY `contact_id` HAVING COUNT(*) > 5) AS `fr`
ON contacts.id = `fr`.`contact_id</code>
        </pre>
        <div class="code">
            @foreach($contacts as $item)
            <div>{{ $item->id }}: {{ $item->name }} - {{ $item->fr_count }}</div>
            @endforeach
        </div>
        <div class="company-text">
        <br>
        <p>Запрос sql, отображающий все пары Контактов, которые дружат друг с другом, исключая дубликаты. Для этого будем генерировать промежуточную таблицу tab(contact_id, friend_id, couple_id) где будем хранить полные пары друзей, и в 3ий столбец будем помещать больший id из пары, и затем группировать по 3ему столбцу чтобы исключить дубликаты. На основе промежуточной таблицы будем получать имена из таблицы contacts</p>
    </div>
        <pre>
            <code class="language-sql">SELECT con1.name AS name1, con2.name AS name2 FROM (contacts con1, contacts con2)
        JOIN
        (SELECT t2.contact_id, t2.friend_id,
        IF(t1.contact_id > t1.friend_id, t1.contact_id, t1.friend_id) couple_id
          FROM friends t1, friends t2
          WHERE t1.contact_id=t2.friend_id AND t1.friend_id=t2.contact_id
          GROUP BY couple_id) tab
        ON con1.id=tab.contact_id AND con2.id=tab.friend_id</code>
        </pre>
    <div class="company-text">
        <p>После выполнения данного запроса мы получим нужные данные, однако данный запрос не соответствует "strict mode" правилу ONLY_FULL_GROUP_BY. Чтобы не отключать данный режим исправим запрос, для этого при формировании промежуточной таблцы добавим еще один подзапрос</p>
    </div>
        <pre>
            <code class="language-sql">SELECT con1.name AS name1, con2.name AS name2 FROM (contacts con1, contacts con2)
JOIN
(SELECT t3.contact_id, t3.friend_id, couple_id FROM
    (SELECT t2.contact_id, t2.friend_id,
        CASE
        WHEN t1.friend_id=t2.contact_id AND t1.contact_id=t2.friend_id THEN
            IF(t1.contact_id > t1.friend_id, t1.contact_id, t1.friend_id)
        ELSE -1
        END couple_id
    FROM (friends t1, friends t2)) t3
    WHERE couple_id <> -1
    GROUP BY couple_id) tab
ON con1.id=tab.contact_id AND con2.id=tab.friend_id</code>
        </pre>
        <div class="code">
            @foreach($couple as $item)
            <div>{{ $item->name1 }} - {{ $item->name2 }}</div>
            @endforeach
        </div>
        <div class="company-text">
        <br>
        <p>Мы получили решение, но для реальной задачи такая структура может быть не оптимальна. Лучше в таблице friends хранить статус состояния дружбы (1ый дружит со 2ым, 2ой дружит с 1ым, дружат вместе) и отслеживать корректность заполнения при добавлении данных в таблицу</p>
    </div>

@endsection

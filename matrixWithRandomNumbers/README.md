# Массив, заполненный случайными уникальными числами

Нужно заполнить массив 5 на 7 случайными уникальными числами от 1 до 1000.
Вывести получившийся массив и суммы по строкам и по столбцам.

## Решение:



Поэтому можно решить данную задачу, выбирая случайные уникальные числа каждый раз из сужающегося набора значений.

### Способы получить случайное целое в php:

| Функция                                                                                               | Требования | Особенности                                                      |
|-------------------------------------------------------------------------------------------------------|------------|------------------------------------------------------------------|
| [rand](https://www.php.net/manual/ru/function.rand)                                                   | php4..php8 | начиная с 7.1.0 - синоним mt_rand                                |
| [mt_rand](https://www.php.net/manual/ru/function.mt-rand)                                             | php4..php8 |                                                                  |
| [random_int](https://www.php.net/manual/ru/function.random-int)                                       | php7..php8 | криптобезопасна, поэтому возможно более требовательна к ресурсам |
| [array_rand](https://www.php.net/manual/ru/function.array-rand)                                       | php4..php8 | внутренняя реализация родственна mt_rand -  на вихре Мерсена     |
| [shuffle](https://www.php.net/manual/ru/function.shuffle.php)                                         | php4..php8 | перемешивание массива на вихре Мерсена                           |
| [Random\Randomizer::getInt](https://www.php.net/manual/ru/random-randomizer.getint.php)               | >= 8.2.0   | Появилась в свежем релизе php                                    |
| [Random\Randomizer::shuffleArray](https://www.php.net/manual/ru/random-randomizer.shufflearray.php)   | >=  8.2.0  |                                                                  |
| [Random\Randomizer::pickArrayKeys](https://www.php.net/manual/ru/random-randomizer.pickarraykeys.php) | >=  8.2.0  |                                                                  |

Есть несколько вариантов реализации алгоритма:
1. [[NAIVE][]] запуск генератора случайных чисел без связи с уже заполненными ячейками, отсеивая полученные значения по факту, в рекурсивной функции.
   В худшем случае мы получаем непредсказуемое время работы скрипта и такую же сложность алгоритма.
2. [[SHIFT](src/RandomUniqueIntGenerator/Shift.php)] при повторном выпадении уже выпадавшего ранее значения - можно сместиться вверх к следующему за ним значению, а если 
оно находится за пределами заданного интервала значений - то брать с начала интервала. (эту гипотезу нужно исследовать на 
случайность распределения). Так как выбор по arr[$key] стремится к O(1) - отброс уже существующих значений будет достаточно эффективным.
3. выбирать в два этапа - сначала один из неиспользованных интервалов, а потом значение из этого интервала. Есть также опасение
в нарушении случайного распределения в этом случае, за счет того, что неодинаковые по количеству элементов группы выбираются
на первом этапе равновероятно.
4. [[LOTO](src/RandomUniqueIntGenerator/Loto.php)] выбирать из массива, который первоначально 
наполнить полным диапазоном значений. Примерно так делают, когда играют в лото.

По форматированию вывода - выводим для cli ascII таблицу по образцу:
```text
 -------------- Σ --
  | 1 | 2 | 3 | 6  |
 ------------------
  | 3 | 4 | 5 | 12 |
 -------------------
Σ | 4 | 6 | 8 |    |
 -------------------
```

<img align="left" height="30%" src="../assets/loto.jpg" title="loto" width="30%"/>В ходе 
реализации по алгоритму **LOTO** - выяснилось ряд особенностей. Алгоритм ограничен по максимальному количеству 
элементов массива - проверяется при создании генератора из входящих условий. И это ограничение - не PHP_INT_MAX как можно
было бы предположить, и не 2147483647 - а 1073741822 (подобрал эмпирически). На других системах значение другое - например 
на https://3v4l.org/#live - 67108862, при том что PHP_INT_MAX=2147483647. Также алгоритм сильно ограничен по объему памяти,
поскольку именно ее объем лимитирует на самом деле количество элементов.

Для внутренней реализации перемешивания возможно два варианта.
Первый [Loto.php](./src/RandomUniqueIntGenerator/Loto.php) использует выборку элемента массива по случайному индексу с дальнейшим удалением элемента из массива и сбросом ключей.
Второй [Shuffle.php](./src/RandomUniqueIntGenerator/Shuffle.php) - формирует массив последовательных значений и перемешивает их с помощью shuffle. После инициализации генератора - 
элементы выдаются последовательно и вызова генератора случайных чисел не производится.

**Инсайты:**
- Использование функции рандома внутри классов - делает их нетестируемыми. Так как протестировать их мы не можем - то выносим за пределы классов.
- Класс Random\Randomizer финальный без прилепленного интерфейса, это приглашает нас создавать и реализовывать свой интерфейс
с адаптером, проксирующим его вызовы
- Адаптер, учитывая минимум логики - можно исключить из покрытия тестов - здравых мыслей как обложить его тестами не нашлось.
Место ему в инфраструктурном слое, в тестах легко создать фейковую имплементацию.
- При использовании Random\Randomizer - его даже подменять на фейк не нужно - достаточно ему подложить фейковый Engine, 
главное чтобы в реализации не было инкапсулировано сама инициализация рандомайзера.

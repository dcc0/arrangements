<?php
/*Размещения с повторениями. Arrangements with repetitions*/
/*Переменная считает число объектов.
 * This variable counts the number of objects.*/
$h=0;

/*Our arrays. Массив*/
$c=array(1,2,3,4,5);
$b=array(1,1,1,1,1);

$k = 5; /*Set a value. Ваше значение.*/
$n = 5; /*Set a value. Ваше значение.*/
/*Permute first. Первые объекты вне циклов (
 * поэтому почти эвристика)*/
permute($b,$h);

/*Combinations with repetitions. Сочетания с повторениями.*/
while (1)
	{
	/*Here we search an element in array C greater than K in array B.
	* Ищем элемент в массиве С, больше на единицу, чем
	* элемент в B на позиции K*/
		if (array_search($b[$k-1]+1,$c)!==false )
		{
		/*Found. Here we increase element per 1.
		* Нашли. Увеличиваем на единицу.*/
		$b[$k-1] = $b[$k-1] + 1;
		permute($b,$h);
		}
	/*Если последний элемент в массива B равен n
	* - старшему значению, то цикл поиска элемента слева от К,
	* для которого в массиве C есть больший на единицу.*/
	if ($b[$k - 1] == $n)
		{
		$i = $k - 1;
		/*Просмотр массива справа налево.
		* Looking greater element (from right to left).*/
		while ($i >= 0)
			{
			/*Если дошли до 0 индекса и таких элементов нет,
			* то алгоритм завершается.
			* Index 0 and we didn't find the element.
			* This condition stops the algorithm.*/
			if ($i == 0 && $b[$i] == $n ) break 2;
			/*Поиск элемента для увеличения.
			* Looking for an element to increase it.*/
			$more_per_unit = array_search($b[$i] + 1, $c);
			if ($more_per_unit !== false)
				{
				$c[$more_per_unit] = $c[$more_per_unit] - 1;
				$b[$i] = $b[$i] + 1;
				/*Перенос значений в С. Заполнение  массива B до K*.
				*Here we transport elements to C and fill array B till K.*/
				for  ($j=$i; $j < $k-1; $j++) {
				array_unshift ($c, $b[$j+1]);
				$b[$j+1]=$b[$i];

				}
				/*Удаление повторяющихся значений из C.*
				* Here we remove duplicates out of C.*/
				$c = array_diff($c, $b);
				permute($b,$h);
				/*Here we add n to the array C.
				 * Добавим n в массив С*/
				array_unshift ($c, $n);
				break;
				}
			$i--;
			}
		}
	}
  
  
/*Функция перестановок. Permutations function.*/
function permute($b,&$h)
	{
	/*Дублируем массив и перевернем его. Это нужно для выхода
	 * из алгоритма.
	 * Here we make a copy and reverse our array. It is necessary to
	 * stop the algorithm.*/
	$a = $b;
	$a = array_reverse($b);
	while (1)
		{

		/*Печать и условие выхода. Here we print and exit.*/
		print_r($a);
		print "\n";
		$h++;
		if ($a == $b) break;

		/*Ищем следующую перестановку.
		 * Here we search next permutation.*/
		$i = 1;
		while ($a[$i] >= $a[$i - 1])
			{
			$i++;
			}
		$j = 0;
		while ($a[$j] <= $a[$i])
			{
			$j++;
			}
		/*Обмен. Here we change.*/
		$c = $a[$j];
		$a[$j] = $a[$i];
		$a[$i] = $c;

		/*Обернем хвост. Tail reverse.*/
		$c = $a;
		$z = 0;
		for ($i-= 1; $i > - 1; $i--) $a[$z++] = $c[$i];
		}
}
echo $h;
?>

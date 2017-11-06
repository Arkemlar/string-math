<?php


namespace Arkemlar\EndlessMath;


class Resolver
{
	/**
	 * @param string $a
	 * @param string $b
	 *
	 * @return string
	 */
	public static function sum(string $a, string $b): string
	{
//		dump($a,$b);
		
		$a = new IntNumber($a);
		$b = new IntNumber($b);
		
		// Определим равны ли знаки у представленных чисел
		$isSameSign = $a->isPositive() === $b->isPositive();
		
		// Уравняем длину строк и отсортируем числа в порядке увеличения абсолютного значения (для правильной работы алгоритма число А должно быть больще Б)
		$lengthDiff = abs($a->getLength() - $b->getLength());
		if($a->getLength() !== $b->getLength()) {
			// Сравнение по длине
			if ($a->getLength() > $b->getLength()) {    // a длиннее, чем b
				$b = new IntNumber($b->getNumber(), $lengthDiff);
			} else {
				$a = new IntNumber($a->getNumber(), $lengthDiff);
				// т.к. b длиннее - меняем их местами
				[$a, $b] = [$b, $a];
			}
		} else {
			// Сравнение по значению
			$i = $a->getLength()-1;
			while ($i >= 0) {
				if($b[$i] > $a[$i]) {
					// т.к. b больше - меняем их местами
					[$a, $b] = [$b, $a];
					break;
				}
				$i--;
			}
		}
		
//		dump($a,$b);
		
		// Считаем как в школе учили - столбиком :D
		$i = $a->getLength()-1;
		$result = [];
		$rememberFlag = false;
		while ($i >= 0) {
		
			$intA = $a[$i];
			$intB = $b[$i];
			
//			dump([$intA, $intB]);
			
			// Число А всегда длиннее, чем Б, поэтому если Б ещё не закончилось - условие $i >= $lengthDiff выполняется
			if ($i >= $lengthDiff) {
				if ($isSameSign) {
					$result[] = self::doAdd($intA, $intB, $rememberFlag);
				} else {
					$result[] = self::doSubtract($intA, $intB, $rememberFlag);
				}
			} else {
				if ($rememberFlag) {
					$intA += $isSameSign ? 1 : -1;
					$rememberFlag = false;
				}
				$result[] = $intA;
			}
			
			$i--;
		}
		if($rememberFlag) $result[] = 1;
		$result = ($a->isPositive() ? '' : '-') .implode(array_reverse($result));
		
//		dump($result);
		
		return $result;
	}
	
	/**
	 * Сложение двух чисел представленных одной цифрой
	 *
	 * @param int  $a
	 * @param int  $b
	 * @param bool $rememberFlag
	 *
	 * @return int
	 */
	protected static function doAdd(int $a, int $b, bool &$rememberFlag): int
	{
		$resultNumber = $a + $b;
		if ($rememberFlag) $resultNumber += 1;
		if ($resultNumber > 9) {
			$rememberFlag = true;
			$resultNumber -= 10;
		} else {
			$rememberFlag = false;
		}
		return $resultNumber;
	}
	
	/**
	 * Вычитание двух чисел представленных одной цифрой
	 *
	 * @param int  $a
	 * @param int  $b
	 * @param bool $rememberFlag
	 *
	 * @return int
	 */
	protected static function doSubtract(int $a, int $b, bool &$rememberFlag): int
	{
		$resultNumber = $a - $b;
		if ($rememberFlag) $resultNumber -= 1;
		if ($resultNumber < 0) {
			$rememberFlag = true;
			$resultNumber += 10;
		} else {
			$rememberFlag = false;
		}
		return $resultNumber;
	}
}
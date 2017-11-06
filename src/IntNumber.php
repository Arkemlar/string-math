<?php

namespace Arkemlar\EndlessMath;

class IntNumber implements \ArrayAccess
{
	protected $positive = true;
	protected $length;
	protected $value;
	
	public function __construct(string $value, int $padLength = 0)
	{
		$matches = [];
		if (1 !== preg_match('/^-?[0]*(?<number>[\d]+)$/', $value, $matches))
			throw new \InvalidArgumentException(sprintf("String '%s' is not valid to be integer", $value));
		
		$this->positive = $value[0] !== '-';
		$this->value = str_repeat('0', $padLength).$matches['number'];
		$this->length = strlen($this->value);
	}
	
	/**
	 * Возвращает абсолютное значение числа (без знака)
	 *
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}
	
	/**
	 * Возвращает длину числа
	 *
	 * @return int
	 */
	public function getLength(): int
	{
		return $this->length;
	}
	
	/**
	 * Возвращает число с учётом знака
	 *
	 * @return string
	 */
	public function getNumber(): string
	{
		return ($this->isPositive() ? '' : '-').$this->value;
	}
	
	/**
	 * Позволяет узнать знак числа
	 *
	 * @return bool
	 */
	public function isPositive(): bool
	{
		return $this->positive;
	}
	
	public function offsetExists($offset)
	{
		return isset($this->value[$offset]);
	}
	
	public function offsetGet($offset) : int
	{
		return (int)($this->value[$offset] ?? 0);
	}
	
	public function offsetSet($offset, $value) : void
	{
		$this->value[$offset] = $value;
	}
	
	public function offsetUnset($offset) : void
	{
		unset($this->value[$offset]);
	}
	
	
}
<?php
namespace Arkemlar\EndlessMath;

class ResolverTest extends \PHPUnit\Framework\TestCase
{
	public function testShort()
	{
		$this->assertEquals('31467', Resolver::sum('213', '31254'));
		$this->assertEquals('31467', Resolver::sum('31254', '213'));
		$this->assertEquals('-30933', Resolver::sum('00321', '-31254'));
		$this->assertEquals('297', Resolver::sum('00321', '-00024'));
		$this->assertEquals('-71', Resolver::sum('105', '-176'));
		$this->assertEquals('2929', Resolver::sum('3105', '-176'));
	}
	
	public function testLong()
	{
		$this->assertEquals('21342343252310023689786528176073291362800478658337638399281677746', Resolver::sum('21342343252310023689786210532529670395762535234234123130213923123', '317643543620967037943424103515269067754623'));
		$this->assertEquals('21342343252310023689785892888986049428724591810130607861146168500', Resolver::sum('21342343252310023689786210532529670395762535234234123130213923123', '-317643543620967037943424103515269067754623'));
	}
	
	public function testRandom()
	{
		for ($i = 100; $i > 0; $i--) {
			$a = random_int(0, 9999999999);
			$b = random_int(0, 9999999999);
			$this->assertEquals($a+$b, Resolver::sum((string)$a, (string)$b));
		}
	}
}
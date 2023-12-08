<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once 'NextSmallestNumberFinder.php';

class NextSmallestNumberFinderTest extends TestCase
{
    /**
     * @var int[]
     */
    protected array $dataset = [3, 4, 6, 9, 10, 12, 14, 15, 17, 19, 21];

    /**
     * @return void
     */
    public function testFindNextSmallestTrivial()
    {
        $finder = new NextSmallestNumberFinder($this->dataset);

        $this->assertEquals(10, $finder->findNextSmallestTrivial(11));
        $this->assertEquals(12, $finder->findNextSmallestTrivial(14));
        $this->assertEquals(17, $finder->findNextSmallestTrivial(18));

        $this->assertEquals(-1, $finder->findNextSmallestTrivial('abc'));
        $this->assertEquals(-1, $finder->findNextSmallestTrivial(-5));
    }

    /**
     * @return void
     */
    public function testFindNextSmallestBinary()
    {
        $finder = new NextSmallestNumberFinder($this->dataset);

        $this->assertEquals(10, $finder->findNextSmallestBinary(11));
        $this->assertEquals(12, $finder->findNextSmallestBinary(14));
        $this->assertEquals(17, $finder->findNextSmallestBinary(18));

        $this->assertEquals(-1, $finder->findNextSmallestBinary('abc'));
        $this->assertEquals(-1, $finder->findNextSmallestBinary(-5));
    }

    /**
     * @return void
     */
    public function testFindNextSmallestLinear()
    {
        $finder = new NextSmallestNumberFinder($this->dataset);

        $this->assertEquals(10, $finder->findNextSmallestLinear(11));
        $this->assertEquals(12, $finder->findNextSmallestLinear(14));

        $this->assertEquals(-1, $finder->findNextSmallestLinear('abc'));
        $this->assertEquals(-1, $finder->findNextSmallestLinear(-5));
    }

    /**
     * @return void
     */
    public function testFindNextSmallestTernary()
    {
        $finder = new NextSmallestNumberFinder($this->dataset);

        $this->assertEquals(10, $finder->findNextSmallestTernary(11));
        $this->assertEquals(12, $finder->findNextSmallestTernary(14));

        $this->assertEquals(-1, $finder->findNextSmallestTernary('abc'));
        $this->assertEquals(-1, $finder->findNextSmallestTernary(-5));

        $this->assertEquals(-1, $finder->findNextSmallestTernary(100));
    }

    /**
     * @return void
     */
    public function testFindNextSmallestQuickSort()
    {
        $finder = new NextSmallestNumberFinder($this->dataset);

        $this->assertEquals(10, $finder->findNextSmallestQuickSort(11));
        $this->assertEquals(12, $finder->findNextSmallestQuickSort(14));

        $this->assertEquals(-1, $finder->findNextSmallestQuickSort('abc'));
        $this->assertEquals(-1, $finder->findNextSmallestQuickSort(-5));

        $this->assertEquals(-1, $finder->findNextSmallestQuickSort(100));
    }

    /**
     * @return void
     */
    public function testFindNextSmallestMergeSort()
    {
        $finder = new NextSmallestNumberFinder($this->dataset);

        $this->assertEquals(10, $finder->findNextSmallestMergeSort(11));
        $this->assertEquals(12, $finder->findNextSmallestMergeSort(14));

        $this->assertEquals(-1, $finder->findNextSmallestMergeSort('abc'));
        $this->assertEquals(-1, $finder->findNextSmallestMergeSort(-5));

        $this->assertEquals(-1, $finder->findNextSmallestMergeSort(100));
    }
}
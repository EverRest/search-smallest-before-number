<?php
declare(strict_types=1);

class NextSmallestNumberFinder
{
    /**
     * @var array
     */
    private array $dataset;

    /**
     * @param array $dataset
     */
    public function __construct(array $dataset)
    {
        $this->dataset = $dataset;
    }

    /**
     * @param $number
     *
     * @return int|mixed
     */
    public function findNextSmallestTrivial($number): mixed
    {
        if (!is_numeric($number) || $number < min($this->dataset) || $number > max($this->dataset)) {
            return -1;
        }
        $filteredNumbers = array_filter($this->dataset, function ($value) use ($number) {
            return $value < $number;
        });
        if (empty($filteredNumbers)) {
            return -1;
        }

        return max($filteredNumbers);
    }

    /**
     * @param $number
     *
     * @return mixed
     */
    public function findNextSmallestLinear($number): mixed
    {
        if (!is_numeric($number) || $number < min($this->dataset) || $number > max($this->dataset)) {
            return -1;
        }
        $found = false;
        $nextSmallest = -1;

        foreach ($this->dataset as $value) {
            if ($value >= $number) {
                break;
            }
            $found = true;
            $nextSmallest = $value;
        }

        return $found ? $nextSmallest : -1;
    }

    /**
     * @param $number
     *
     * @return int|mixed
     */
    public function findNextSmallestBinary($number): mixed
    {
        sort($this->dataset);
        $min = $this->dataset[0];
        $max = $this->dataset[count($this->dataset) - 1];
        if (!is_numeric($number) || $number < $min || $number > $max) {
            return -1;
        }
        $low = 0;
        $high = count($this->dataset) - 1;
        while ($low <= $high) {
            $mid = $low + floor(($high - $low) / 2);

            if ($this->dataset[$mid] >= $number) {
                $high = $mid - 1;
            } else {
                $low = $mid + 1;
            }
        }

        return ($high >= 0) ? $this->dataset[$high] : -1;
    }

    /**
     * @param $number
     *
     * @return int
     */
    public function findNextSmallestTernary($number): int
    {
        sort($this->dataset);
        if (!is_numeric($number) || $number < $this->dataset[0] || $number > $this->dataset[count($this->dataset) - 1]) {
            return -1;
        }

        $low = 0;
        $high = count($this->dataset) - 1;

        while ($low <= $high) {
            $mid1 = $low + floor(($high - $low) / 3);
            $mid2 = $high - floor(($high - $low) / 3);

            if ($this->dataset[$mid1] >= $number) {
                $high = $mid1 - 1;
            } elseif ($this->dataset[$mid2] < $number) {
                $low = $mid2 + 1;
            } else {
                $low = $mid1 + 1;
                $high = $mid2 - 1;
            }
        }

        return ($high >= 0) ? $this->dataset[$high] : -1;
    }

    /**
     * @param $number
     *
     * @return mixed
     */
    public function findNextSmallestQuickSort($number): mixed
    {
        if (!is_numeric($number) || $number < min($this->dataset) || $number > max($this->dataset)) {
            return -1;
        }
        $this->quickSort($this->dataset, 0, count($this->dataset) - 1);

        return $this->binarySearch($number);
    }

    /**
     * @param $number
     *
     * @return mixed
     */
    public function findNextSmallestMergeSort($number):mixed
    {
        if (!is_numeric($number) || $number < min($this->dataset) || $number > max($this->dataset)) {
            return -1;
        }
        $this->mergeSort($this->dataset);

        return $this->binarySearch($number);
    }

    /**
     * @param $number
     *
     * @return mixed
     */
    private function binarySearch($number): mixed
    {
        $low = 0;
        $high = count($this->dataset) - 1;

        while ($low <= $high) {
            $mid = $low + floor(($high - $low) / 2);

            if ($this->dataset[$mid] == $number) {
                return ($mid - 1 >= 0) ? $this->dataset[$mid - 1] : -1;
            } elseif ($this->dataset[$mid] < $number) {
                $low = $mid + 1;
            } else {
                $high = $mid - 1;
            }
        }

        return ($high >= 0) ? $this->dataset[$high] : -1;
    }

    /**
     * @param array $array
     *
     * @return void
     */
    private function mergeSort(array &$array): void
    {
        $n = count($array);
        if ($n > 1) {
            $mid = floor($n / 2);
            $left = array_slice($array, 0, intval($mid));
            $right = array_slice($array, intval($mid));
            $this->mergeSort($left);
            $this->mergeSort($right);
            $this->merge($array, $left, $right);
        }
    }

    /**
     * @param array $array
     * @param array $left
     * @param array $right
     *
     * @return void
     */
    private function merge(array &$array, array $left, array $right): void
    {
        $i = $j = $k = 0;
        $nL = count($left);
        $nR = count($right);
        while ($i < $nL && $j < $nR) {
            if ($left[$i] <= $right[$j]) {
                $array[$k++] = $left[$i++];
            } else {
                $array[$k++] = $right[$j++];
            }
        }
        while ($i < $nL) {
            $array[$k++] = $left[$i++];
        }
        while ($j < $nR) {
            $array[$k++] = $right[$j++];
        }
    }

    /**
     * @param array $array
     * @param $low
     * @param $high
     *
     * @return void
     */
    private function quickSort(array &$array, $low, $high): void
    {
        if ($low < $high) {
            $partitionIndex = $this->partition($array, $low, $high);
            $this->quickSort($array, $low, $partitionIndex - 1);
            $this->quickSort($array, $partitionIndex + 1, $high);
        }
    }

    /**
     * @param array $array
     * @param $low
     * @param $high
     *
     * @return int
     */
    private function partition(array &$array, $low, $high): int
    {
        $pivot = $array[$high];
        $i = $low - 1;
        for ($j = $low; $j < $high; $j++) {
            if ($array[$j] <= $pivot) {
                $i++;
                $this->swap($array, $i, $j);
            }
        }
        $this->swap($array, $i + 1, $high);

        return $i + 1;
    }

    /**
     * @param array $array
     * @param $i
     * @param $j
     *
     * @return void
     */
    private function swap(array &$array, $i, $j): void
    {
        $temp = $array[$i];
        $array[$i] = $array[$j];
        $array[$j] = $temp;
    }
}
<?php

/**
 * Not that mysterious function foo()
 * 
 * @param array $ranges an array of integer pairs
 * @return array an array of integer pairs
 */
function foo($ranges) {
    // where the final ranges will be stored
    $unions = [];

    foreach ($ranges as $range) {
        $rangeAdded = false;
        foreach ($unions as &$union) {
            // If the range intersects with the previously stored range
            if (
                $range[0] >= $union[0] && $range[0] <= $union[1]
                || $range[1] >= $union[0] && $range[1] <= $union[1]    
            ) {
                // Merge the range by getting the smallest value and the biggest value
                $union = [
                    min($range[0], $range[1], $union[0], $union[1]),
                    max($range[0], $range[1], $union[0], $union[1])
                ];
                $rangeAdded = true;
                break;
            }
        }
        // If this range has not been added it means that it doesn't intersect with any 
        // previously stored ranges, or that it's the first one, we should add it
        if (!$rangeAdded) {
            $unions[] = $range;
        }
    }

    sort($unions);

    return $unions;
}

echo "<pre>";
print_r(foo([[0, 3], [6, 10]]));
print_r(foo([[0, 5], [3, 10]]));
print_r(foo([[0, 5], [2, 4]]));
print_r(foo([[7, 8], [3, 6], [2, 4]]));
print_r(foo([[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]]));
echo "</pre>";

?>
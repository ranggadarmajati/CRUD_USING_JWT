// Class
class ProblemSolvingBasic {
    // function minMaxSum
    minMaxSum(numbers, sumEverything = false) {
        // Sort the array in ascending order
        numbers.sort((a, b) => a - b);

        // Calculate the sum of all elements
        const totalSum = numbers.reduce((acc, num) => acc + num, 0);
        // rdo this if sumEverything is false
        if (!sumEverything) {
            // Calculate the minimum sum (excluding the maximum element)
            const minSum = totalSum - numbers[numbers.length - 1];

            // Calculate the maximum sum (excluding the minimum element)
            const maxSum = totalSum - numbers[0];

            // Print the respective minimum and maximum values
            console.log("result is :", minSum, maxSum + "\n");
        } else {
            // loop the array numbers
            for (const [i, value] of numbers.entries()) {
                // Calculate the maximum sum (excluding the index of element)
                const maxSum = totalSum - numbers[i];

                // Print result sum everything except
                console.log(`sum everything except ${value} the result sum is :`, maxSum);
            }
        }
    }

    // function plusMinus
    plusMinus(numbers) {
        // length of array numbers
        const arrSize = numbers.length;
        // for hold positive value
        let positive = 0;

        // for hold negative value
        let negative = 0;

        // for hold zero value
        let zero = 0;

        // loop for save increment value of zero, positive, & negative
        for (const number of numbers) {
            if (number === 0) {
                zero++;
            } else if (number > 0) {
                positive++;
            } else {
                negative++;
            }
        }

        console.log("Resuls is:");
        console.log((positive / arrSize).toFixed(6));
        console.log((negative / arrSize).toFixed(6));
        console.log((zero / arrSize).toFixed(6));
    }

    // Function timeConversion
    timeConversion(time12) {
        // Get AM/PM from time12
        const modifier = time12.slice(-2);

        // Get Hours, minutes, seconds, & AM/PM from time12
        const [hours, minutes, seconds] = time12.split(':');

        // Convert clock to 24 hour format
        let newHours = parseInt(hours, 10);
        if (modifier === 'PM' && hours !== '12') {
            newHours += 12;
        } else if (modifier === 'AM') {
            if (hours === '12') {
                newHours = '0';
            }
            if (parseInt(hours) > 12) {
                newHours = parseInt(hours) - 12;
            }
        }

        // Format the hour by adding a leading zero if it is only one digit
        newHours = newHours < 10 ? '0' + newHours : newHours.toString();

        // Returns a string in 24 hour format
        return `${newHours}:${minutes}:${seconds.slice(0, 2)}`;
    }
}
const problemSolvingBasic = new ProblemSolvingBasic();
// Test 1
console.log("======================= TEST 1 =============================");
console.log("const arrNumber = [1,3,5,7,9];");
console.log("minMaxSum(arrNumber);");
const arrNumber = [1, 3, 5, 7, 9];
problemSolvingBasic.minMaxSum(arrNumber);

console.log("const arrNumber2 = [1,2,3,4,5];");
console.log("minMaxSum(arrNumber2);");
const arrNumber2 = [1, 2, 3, 4, 5];
problemSolvingBasic.minMaxSum(arrNumber2);

problemSolvingBasic.minMaxSum(arrNumber2, true);
console.log("======================== END ===============================\n");

// Test 2
console.log("======================= TEST 2 =============================");
console.log("STDIN							FUNCTION");
console.log("-----							--------");
console.log("5					        arr[] size n = 5");
console.log("1 1 0 -1 -1					arr = [1, 1, 0, -1, -1]");
problemSolvingBasic.plusMinus([1, 1, 0, -1, -1]);
console.log("");
console.log("STDIN							FUNCTION");
console.log("-----							--------");
console.log("6					        arr[] size n = 6");
console.log("-4 3 -9 0 4 1					arr = [-4, 3, -9, 0, 4, 1]");
problemSolvingBasic.plusMinus([-4, 3, -9, 0, 4, 1]);
console.log("======================== END ===============================\n");

// Test 3
console.log("======================= TEST 3 =============================");
console.log(`a = '12:01:00PM' return ${problemSolvingBasic.timeConversion('12:01:00PM')}`);
console.log(`a = '12:01:00AM' return ${problemSolvingBasic.timeConversion('12:01:00AM')}`);
console.log(`a = '07:05:45PM' return ${problemSolvingBasic.timeConversion('07:05:45PM')}`);
console.log("======================== END ===============================\n");

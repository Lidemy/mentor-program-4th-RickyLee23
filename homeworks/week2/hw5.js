function join(arr, concatStr) {
        var newarray = []
        newarray = newarray + arr[0]
        for (var i=1;i<arr.length;i++){
                newarray = newarray+concatStr + arr[i]
        }
        return newarray
}

function repeat(str, times) {
        var repeat = []
        for (i=1;i<=times;i++){
                repeat = repeat + str
        }
        return repeat
}

console.log(join([1, 2, 3], ''))
console.log(join(["a", "b", "c"], "!"))
console.log(join(["a", 1, "b", 2, "c", 3], ','))

console.log(repeat('a', 5))
console.log(repeat('yoyo', 2))
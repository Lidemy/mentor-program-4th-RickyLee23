function reverse(str) {
        var word = str.split('')
        var newstring = ''
        for (var i=0 ; i<str.length ; i++ ){
                newstring = newstring + word[(str.length-1)-i]
        }
        console.log(newstring)
}

reverse('hello');

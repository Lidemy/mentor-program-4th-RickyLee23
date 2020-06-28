function capitalize(str) {
        var word = str.split('')
        if (word[0]>='A' && word[0]<='Z'){
                return word[0]
        }else if (word[0]>= 'a' && word[0]<= 'z'){
                var aCode = word[0].charCodeAt(0)
                return String.fromCharCode(aCode-32)
        }else{
                return str
        }
        
}

capitalize(',,hello')

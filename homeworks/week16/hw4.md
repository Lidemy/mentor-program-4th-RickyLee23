```
const obj = {
  value: 1,
  hello: function() {
    console.log(this.value)
  },
  inner: {
    value: 2,
    hello: function() {
      console.log(this.value)
    }
  }
}
  
const obj2 = obj.inner
const hello = obj.inner.hello
obj.inner.hello()
obj2.hello()
hello()
```

**obj.inner.hello( )  轉換成 obj.inner.hello( ).call(obj.inner) --> 2**

**obj2.hello( )  轉換成 obj2.hello().call(obj2) --> obj.inner.hello().call(obj.inner) --> 2**

**hello( )  轉換成 hello.call() --> undefined**
# java learn

- `public static void main(String[] args)`是一个方法，这是Java程序的入口

  - 任何Java程序的代码都是从这个方法开始执行的

- `System.out.println("Hello 天码营！");`是一个方法的调用，这行代码向控制台输出了

  `Hello 天码营！`

  - 这行代码你可能还看不太懂，你现在只需知道：将希望输出信息放到`System.out.println(...)`的括号内就能在控制台中显示出来
  - 注意`System.out.print()`和`System.out.println()`区别，后者会在最后增加一个换行符号



## *Java中的注释分为三种类型。*

- 单行注释：在注释内容前加两个斜线`//`，则Java编译器会忽略掉`//`的信息
- 多行注释：在要注释的内容前面添加`/*`，在注释的内容后添加`*/`
- 文档注释：在要注释的内容前面添加`/**`，在注释的内容后添加`*/`，这是一种特殊的多行注释，注释中的内容可以用以生成程序的文档，具体用法我们以后讲解。

```java
/**
 这是一个文档注释
*/ 
public class HelloWorld {  
    
    /*
     这是一个多行注释。
     在main方法中打印hello信息
    */
    
    public static void main(String[] args) {
        // 打印信息，这是一个单行注释
        System.out.println("Hello 天码营！"); // 这也是一个单行注释，可以跟在一条程序语句后面
    }
    
}
```

>编译注意：
>
>javac xxx.java
>
>否则报错	错误: 仅当显式请求注释处理时才接受类名称 'car'



## *JAVA设置的public类必须与文件同名*

`Car.java`

```java
public class Car {
	int color;	//颜色
	int speed;	//速度
	
	void startup() {
		System.out.println("启动");
	}
	 
	//成员方法
	void run(int speed) {
		System.out.println("我的速度是："+speed);
	}
}
```

>不同名则报错：
>
>HelloWorld.java:1: 错误: 类Post是公共的, 应在名为 Post.java 的文件中声明

## 基本数据类型

### byte

- `byte`数据类型是8位、有符号整数；有符号指的是有正数和负数之分
- 最小值是`-128(-2^7)`
- 最大值是`127(2^7-1)`
- 默认值是`0`
- `byte`类型用在大型数组中节约空间，主要代替整数，因为`byte`变量占用的空间只有`int`类型的四分之一

示例：



```
byte foo = 100;
byte bar = -50;
```

### short

- `short`数据类型是16位、有符号整数
- 最小值是`-32768(-2^15)`
- 最大值是`32767(2^15 - 1)`
- 默认值是`0`
- `short`数据类型也可以像`byte`那样节省空间，一个`short`变量是`int`变量所占空间的二分之一

示例：



```
short number1 = 100;
short number2 = -2000。
```

### int

- `int`数据类型是32位、有符号整数
- 最小值是`-2,147,483,648(-2^31)`
- 最大值是`2,147,485,647(2^31 - 1)`
- 默认值是`0`

示例：



```
int number1 = 50000;
int number2 = -60000。
```

整型变量默认为`int`类型。

### long

- `long`数据类型是64位、有符号整数
- 最小值是`-9,223,372,036,854,775,808(-2^63)`
- 最大值是`9,223,372,036,854,775,807(2^63 -1)`
- 默认值是`0L`
- 这种类型主要使用在需要比较大整数的系统上

示例：



```
long number1 = 50000L;
long number2 = -60000L。
```

### float

- `float`数据类型是单精度、32位的浮点数
- `float`在储存大型浮点数组的时候可节省内存空间
- 默认值是`0.0f`
- 浮点数不能用来表示精确的值，如货币



```
float f1 = 123.f;
float f2 = 456.f;
```

### double

- `double`数据类型是双精度、64位的浮点数
- 浮点数的默认类型为`double`类型
- 默认值是`0.0d`
- double类型同样不能表示精确的值，如货币

示例：



```
double number1 = 3333.4;
```

### boolean

- `boolean`数据类型表示一位的信息
- 只有两个取值：`true`和`false`
- 默认值是`false`
- 这种类型只作为一种标志来记录`true`/`false`情况

示例：



```
boolean flag = true；
boolean active = false;
```

### char

- `char`类型是一个单一的16位Unicode字符
- 最小值是`'\u0000'`（即为0）
- 最大值是`'\uffff'`（即为65,535）
- 默认值是`'\u0000'`（即为0）
- `char`数据类型可以储存任何字符

示例：



```
char letter = 'A';
```

>'=='和'!='作为关系运算符只用来比较对象的引用。

>如果想比较两个对象实际内容是否相同，需要调用对象的equals()方法。比如判断一个字符串str的内容是否为"abcd"，应该这样比较：
```
if (str.equals("abcd")) {
}
```

`Syntax error, insert "}" to complete ClassBody`漏括号
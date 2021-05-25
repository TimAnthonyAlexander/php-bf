# php-bf
PHP Brainf*ck Interpreter

This basic php interpreter was written just for fun and can only interpret:

+-><[].

It does not support the , operator (yet).


The interpreter can be called like this:

./interpreter.php codefile.bf
./interpreter.php '+-><[].'

If no argument is used, the interpreter will show a hello world example.

The output is like this:

Input:
++++++++++[>+>+++>+++++++>++++++++++<<<<-]>>>++.>+.+++++++..+++.<<++.>+++++++++++++++.>.+++.------.--------.<<+.<.

Output:
Hello World!


Memory:
[0,10,33,87,100]%

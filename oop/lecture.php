<?php
echo "Multiple ways to import namespace";
// Adding backslash means that the class should be found in global scope. 
// Instead of using `\`,  recommended to use `use` keyword.
// inspect(new \Transaction()); 
// inspect(new Transaction());

// inspect(new Gateway\Paddle\Transaction());
// use Gateway\Paddle\Transaction;

// use Gateway\Paddle;
// $paddleTransaction = new Paddle\Transaction();

// use Gateway\Paddle AS PA;
// $paddleTransaction = new PA\Transaction();

// use Gateway\Paddle\{Transaction, AnotherClass};
// $transaction = new Transaction();
// $anotherClass = new AnotherClass();

// use Gateway\Paddle\Transaction as PaddleTransaction;

// Functions and consts fall back to global scope.
// As a convention, if you want to you built-in function, prepend `\` also for speed improvements (negligible).
inspect(\explode(",", "Hello,world"));


echo "Follow PSR";
// PHP Standard Recommendation

echo "Principles of OOP";
// Encapsulation, Abstraction, Inheritance, Polymorphism
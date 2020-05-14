## The Validator Component
The goal of validation is to tell you if the data of an object is valid.

### 1. Simple validation 
#### Let's validate an author object where the `name` can NOT be blank -  meaning not equal to a blank string, a blank array, false or null

code: https://github.com/rilwanfit/symfony-5-learning/commit/3911c8d1c57a2933a5acc21245ceb3b777021392

### 2. Constraint Configuration

#### Let's validate an author object where the `genre` can ONLY be either `fiction` or `non-fiction` and customize the default error message

code: https://github.com/rilwanfit/symfony-5-learning/commit/bebfafed8fc085739c7bec055f659ae018dc17d4

### 3. Constraint Targets 

Constraints can be applied to a class property, a public getter method or an entire class.

#### a class property
previous use-cases show how to apply to a class properties, which can be private, protected or public properties

#### a public getter method 

you can add a constraint to any public method whose name starts with "get", "is" or "has". and the validation will be applied to return value of a method.

#### Let's validate an author object where you want to make sure that a password field doesn't match the first name of the user.

code: https://github.com/rilwanfit/symfony-5-learning/commit/f495f8d2c6ffa21e51134be5c0b6234321cf9937

#### an entire class.

Some constraints apply to the entire class being validated. i.e: Expression, Callback, UniqueEntity, Traverse

### 4. Callback - can be used in all the targets.
The Callback constraint is a great way to define custom validation rules without the need to create custom constraints and validator classes.

The purpose of the Callback constraint is to create completely custom validation rules and to assign any validation errors to specific fields on your object.

 You just need to create one or more methods that does the validation and generates some violations.
 
#### Let's validate an author object where the name is actually a fake name or not, if it is fake, attach the error to `name` field
 
 code: https://github.com/rilwanfit/symfony-5-learning/commit/8ae9428a501445e67c286660cd4d50bcd4990e46 
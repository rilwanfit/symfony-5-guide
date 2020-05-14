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

### 4. Callback - can be used in all three targets.

The purpose of the Callback constraint is to create completely custom validation rules and to assign any validation errors to specific fields on your object.

 You just need to create one or more methods that does the validation and generates some violations.
 
#### Let's validate an author object where the name is actually a fake name or not, if it is fake, attach the error to `name` field
 
 code: https://github.com/rilwanfit/symfony-5-learning/commit/8ae9428a501445e67c286660cd4d50bcd4990e46 
 
### 5. Expression - can be used in all three targets.

The purpose of the Expression constraint is to allows you to use an [https://symfony.com/doc/current/components/expression_language.html#component-expression-language-examples](expression) for more complex, dynamic validation

Imagine you have a class `BlogPost` with `category` and `isTechnicalPost` properties

#### Let's validate a BlogPost object where it meets the following conditions
   - If isTechnicalPost is `true`, then category must be either `php or symfony`
   - If isTechnicalPost is `false`, then category can be `anything`.

   code: https://github.com/rilwanfit/symfony-5-learning/commit/112b9ca57b68e8e0351ed08dab7beb5718a4a0fe
   
### 6. Validation Groups

By default, when validating an object all constraints of this class will be checked.

validation groups will help you to take control over it and then we can apply validation against just one group of constraints.

#### Let's validate a User object where it meets the following conditions.
    - When a user registers we need to check for email and password fields
    - When a user later updates his contact information then we need to check for city field

code: https://github.com/rilwanfit/symfony-5-learning/commit/1a266237c26d989ce31a51893a7d5c0b656fbefd
## The Validator Component
The goal of validation is to tell you if the data of an object is valid.

1. Let's validate an author object where the `name` can NOT be blank -  meaning not equal to a blank string, a blank array, false or null

code: https://github.com/rilwanfit/symfony-5-learning/commit/3911c8d1c57a2933a5acc21245ceb3b777021392

2. Constraint Configuration
Let's validate an author object where the `genre` can ONLY be either `fiction` or `non-fiction` and customize the default error message

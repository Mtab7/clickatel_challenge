Php Specifics Questions and Answers
=============================================

Q: What is your favourite feature added to PHP since version 5.4 and how would you apply it in practice

A: Introduction of Generators has made creating iterators much simpler than previously possible.
Real life example will be parsing large sizes of CSV files that would not fit into memory once parsed or consume too much memory and prevent other requests from being served. Using generators eliminates the creation of arrays which easily consume memory. Reducing the memory consumed helps free resources to serve more requests and use the most out of your hardware. 

Q: What is your framework of choice and what makes it great

A: Laravel – It has an active and growing community that can provide quick support and answers, Laravel has a great way of handling and queuing long running tasks in the background. Queues are great for tasks like saving data where the user must not be blocked from continuing or wait for a process to finish before proceeding to the next step. Also failed jobs can be queued and re-executed in the background.

Q: PHP has to load files and compile code on every request. What would be the best way to improve the
performance of this step.

A: The use of opcache - When an opcode cache is introduced, after a PHP script is interpreted and turned into opcode, it’s saved in shared memory, and subsequent requests will skip the parsing and compilation phases and leverage the opcode stored in memory, reducing the execution time of PHP. 

Q: How do you test newly developed features

A: Re-read the requirement specification, create positive and negative scenarios and cover all possible scenarios. Test the whole application in-case the feature produces side effects to other parts of the application. In an agile development environment all my tests at each stage will also involve the customer / business analyst and their feedback will be used to correct any errors. After doing this challenge I now know the importance of using unit testing during the development process.

Instructions
===============

The company service class manages companies and their users. Each user has a type
that states if they are a user of high worth or low worth. Each user also belongs to a company.

The challenge is to refactor and abstract the code to get rid of duplication and potential
pitfalls in future maintenance. You can change anything aslong as the input and output of the methods remain the same.

The test suite should remain unchanged and should still pass after you are done refactoring.

1. Requirements
===============

You can run and develop this code on any environment that has access to the internet and runs PHP 5.3 and higher.

2. Configure the environment
============================

./composer.phar install

3. Execute the test suite
=========================

./vendor/bin/phpunit


This should run the unit test file where 4 tests and 10 assertions should pass.


4. Share results
================

Once you have finished and everything works, please upload the code to your GitHub profile and send us the link for review.
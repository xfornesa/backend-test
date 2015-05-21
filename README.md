## Video Share

We buy videos from several sources.  Each source provides its content to us in a different format.  Write a command line script to import the videos.    

Input/output should be something like this:
 
````bash
$ import glorf

importing: "science experiment goes wrong"; Url: http://glorf.com/videos/3; Tags: microwave,cats,peanutbutter
importing: "amazing dog can talk"; Url: http://glorf.com/videos/4; Tags: dog,amazing
````

Considerations:

- Currently, we are importing videos from 2 sites: flub, and glorf.  They send us their weekly feed via email.  This weeks files are in /feed-exports
- We plan to add a third provider soon who will make their feed available via json output online via a url (you don't need to implement this, just keep it mind)
- Do not implement any data persistence code, just provide some dummy classes that echo what they are doing.  Keep in mind that the company is planning to switch from MySQL to Cassandra in 4 months.
- The focus here should be on design, more than implementation.  We are less interested in seeing that this works than in seeing how you approach the problem.
- Please provide at least some unit tests (it is not required to write them for every class). Functional tests are also a plus.
- Please provide a short summary detailing anything you think is relevant, for example:
  - Installation steps
  - How to run your code / tests
  - Where to find your code
  - Was it your first time writing a unit test, using a particular framework, etc?
  - What would you have done differently if you had had more time
  - Etc.

* * * 

Please email your completed test to me as a git patch (https://ariejan.net/2009/10/26/how-to-create-and-apply-a-patch-with-git/).

## Installation

Download composer.phar and install dependencies:

    $ php composer.phar install

## Execution

    $ php bin/console video:import glorf

## Tests

    $ php bin/behat -c behat.yml
    $ php bin/phpunit -c phpunit.xml
    
## Considerations

### ParseProviders

I wrote a couple of Parsers, one for each site. Instead of having one Parser by site, we can have one Parser which takes a configuration  (an specification) how to map provided data with a normalized representation, which will then be used to create Video instances.

Then, when a new site provider is required, we will only need to setup some configuration somewhere (database via CMS) to get the import running with no deploy of code.

### Domain events

Instead of printing some information directly to the screen, we can manage this progress publishing an event "new VideoImported($video)" to an EventBus.

Then we can have a VideoImportedSubscriber who logs every video imported and store this information to a log file or simply print to screen.

```php

    class ImportService
    {
        private function raiseVideoImportedEvent(Video $video)
        {
            $bus = EventBus::getInstance();
            $bus->publish(new VideoImported($video));
        }
    
    }

```

For clarity of the code I took a singleton instance instead of injecting the instance.

### Video Builder

Some providers could have some missing information about a video or having different data which others providers do not have. This can will force a large constructor with all the params optionals, or having all the setters to inject the data.

I mean, instead of having a constructor like:

    $video = new Video(null, null, ['tagA']);

or setters with no business intention:

    $video = new Video();
    $video->setTags(['tagA']);

We can write a more meaningful sentence:

    $video = VideoBuilder::aVideo()->withTags(['tagA'])->build();

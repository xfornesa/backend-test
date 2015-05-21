Feature: Import a video feed file

  Scenario: Import an existing site
    Given it exists the feed for "glorf"
    When I import "glorf" site
    Then I should see an output like:
    """
    importing: "science experiment goes wrong"; Url: http://glorf.com/videos/3; Tags: microwave,cats,peanutbutter
    importing: "amazing dog can talk"; Url: http://glorf.com/videos/4; Tags: dog,amazing
    """
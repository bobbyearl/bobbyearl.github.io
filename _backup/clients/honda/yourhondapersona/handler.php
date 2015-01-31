<?php

require_once 'config.php';
$car = $_POST['car'];

?>

{"content":
    {"feed":
        {"template_id":205886185456,
         "template_data":
            {"images":[{"src":"<?php echo $cars_and_responses[$car]['img'] ?>","href":"http://apps.facebook.com/yourhondapersona/"}],"car":"<?php echo $car ?>", "persona":"Find Your Honda Persona", "href":"http://apps.facebook.com/yourhondapersona/", "info":"<?php echo htmlentities($cars_and_responses[$car]['response']); ?>"}
        }
    },
 "method":"feedStory"
} 

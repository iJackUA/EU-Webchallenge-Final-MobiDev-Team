![alt MobiDev](http://mobidev.biz/assets/a271a90b/images/logo.png)
## MobiDev Team. EU Webchallenge Qualification task

## Admin panel
* To log in to the Admin Panel go to  [http://localhost:8888/admin]
* Default admin user is: admin/admin

## Features
* Invites to Answer Survey are sent Automatically every 1 minute. Set the survey "Send Date"=today to send the emails. You can set date in future and wait too ;)
* User receives invite with the link like so: `http://localhost:8888/answer/new/1?secretCode=87651234`. This link should be valid after `vagrant up`.
* You can embed surveys to other site like so `<script src="//localhost:8888/js/embed_survey.js?survey=:survey_id" async></script>`. See an example in `web/test_embed.html` and visit `http://localhost:8888/test_embed.html`. Also you can get embed code at survey's "View" page.
* You can manually visit survey answer page via url `http://localhost:8888/answer/new/:survey_id` for example `http://localhost:8888/answer/new/1`
* Take a look at amazing Vue.js Survey Builder :)

## Participants

* [Viktor Gubochkin](https://github.com/VictorGub)
* [Sergey Koba](https://github.com/sergey-koba-mobidev)
* [Ievgen Kuzminov](https://github.com/iJackUA)

## THX, HAVE FUN

<?php

return [
  'greeting' => function () {
      return new App\Commands\GreetingCommand\GreetingCommand();
  },
];
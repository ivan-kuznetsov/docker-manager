<?php

return [
  'greeting' => function () {
      return new DockerManager\Commands\GreetingCommand\GreetingCommand();
  },
];
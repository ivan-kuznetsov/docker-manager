<?php

return [
  'create' => function () {
      return new DockerManager\Commands\CreateCommand\CreateCommand();
  },
];
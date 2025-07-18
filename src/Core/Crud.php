<?php

namespace Canete\Gs\Core;

interface Crud {
  public function create();
  public function read();
  public function update();
  public function delete();
}
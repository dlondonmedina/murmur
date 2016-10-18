<?php
class Page {
  private $title, $stylesheets=array(), $head_js=array(), $body, $foot_js=array();

  function page() {
    $this->set_css('css/bootstrap.min.css');
    $this->set_head_js('js/bootstrap.min.js');
  }

  function set_title($title) {
    $this->title = $title;
  }

  function set_css($path) {
    $this->stylesheets[] = $path;
  }

  function set_head_js($path) {
    $this->head_js[] = $path;
  }

  function set_foot_js($path) {
    $this->foot_js[] = $path;
  }

  function start_body() {
    ob_start();
  }

  function end_body() {
    $this->body = ob_get_clean();
  }

  function render($path) {
    ob_start();
    include($path);
    return ob_get_clean();
  }
}
